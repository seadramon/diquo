<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Personal;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(){
        return view('pages.user.index');
    }

    public function data()
    {
        $query = User::select('*')->orderBy('created_at', 'desc');

        return DataTables::eloquent($query)
            ->addColumn('menu', function ($model) {
                $column = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('user.edit', $model->id) . '">Edit</a></li>
                            <li><a class="dropdown-item delete" href="javascript:void(0)" data-id="' .$model->id. '" data-toggle="tooltip" data-original-title="Delete">Delete</a></li>
                        </ul>
                        </div>';

                return $column;
            })
            ->rawColumns(['menu'])
            ->toJson();
    }

    public function create()
    {
		$employees = [];

		return view('pages.user.create', compact('employees'));
    }

    public function edit($id)
    {
    	$menulogin = [];

		$data = User::find($id);
		$listmenu = json_decode($data->data);
		$listmenu = $listmenu->web;

		return view('pages.user.edit', compact('id', 'data', 'menulogin', 'listmenu'));
    }

    public function getEmployee(Request $request)
    {
    	$search = !empty($request->search)?strtolower($request->search):"";
    	$result = null;

    	$data = Personal::select('employee_id', 'first_title', 'first_name', 'last_name', 'last_title')
    		->where('kd_pat', '2E');

    	if ($search) {
    		$data->where(function ($query) use($search){
                $query->where(DB::raw("LOWER(employee_id)"), 'LIKE', '%'. $search . '%')
                    ->orWhere(DB::raw("LOWER(first_name)"), 'LIKE', '%'. $search . '%')
                    ->orWhere(DB::raw("LOWER(last_name)"), 'LIKE', '%'. $search . '%');
            });
    	}

    	$result = $data->get();

    	return $result;
    }

    public function store(Request $request)
    {
    	$check = User::where('employee_id', $request->employee_id)->count();

    	if ($check > 0) {
    		return response()->json(['result' => 'failed', 'message' => "The User Login exist!"], 400);
    	}

    	try {
    		DB::beginTransaction();

    		$data = [
    			'web' => $request->listmenu
    		];

    		$user = new User;
    		$user->name = $request->name;
    		$user->username = $request->employee_id;
    		$user->employee_id = $request->employee_id;
    		$user->password = Hash::make($request->password);
    		$user->data = json_encode($data);

    		$user->save();

    		DB::commit();
    		return response()->json(['result' => 'success']);
    	} catch(\Exception $e) {
    		DB::rollback();

    		Log::error("ERROR-CREATE-LOGINUSER " . $e->getMessage());
    		return response()->json(['result' => 'failed', 'message' => "Saving data failed"], 500);
    	}
    }

    public function update($user, Request $request)
    {
    	try {
    		DB::beginTransaction();

    		$data = [
    			'web' => $request->listmenu
    		];

    		$dataupdate = User::find($user);
    		if (!empty($request->password)) {
    			$dataupdate->password = Hash::make($request->password);
    		}
    		$dataupdate->data = json_encode($data);

    		$dataupdate->save();

    		DB::commit();
    		return response()->json(['result' => 'success']);
    	} catch(\Exception $e) {
    		DB::rollback();

    		Log::error("ERROR-UPDATE-LOGINUSER " . $e->getMessage());
    		return response()->json(['result' => 'failed', 'message' => "Saving data failed"], 500);
    	}
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {               
            $data = User::find($request->id);
            $data->delete();

            DB::commit();

            return response()->json(['result' => 'success'])->setStatusCode(200, 'OK');
        } catch(Exception $e) {
            DB::rollback();

            return response()->json(['result' => $e->getMessage()])->setStatusCode(500, 'ERROR');
        }
    }
}
