<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Models\QuotationRequest;
use Carbon\Carbon;
use Exception;
use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class PermintaanPenawaranController extends Controller
{
    public function index(){
        return view('pages.permintaan-penawaran.index');
    }

    public function data()
    {
        $query = QuotationRequest::select('*');

        return DataTables::eloquent($query)
            ->editColumn('status', function ($model) {
                if(in_array($model->status, [null, "baru"])){
                    return "<span class=\"badge badge-light-info\">Baru</span>";
                }
            })
            ->addColumn('menu', function ($model) {
                $column = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('penawaran.create', ['request_id' => $model->id]) . '" target="_blank">Buat Penawaran</a></li>
                        </ul>
                        </div>';

                return $column;
            })
            ->rawColumns(['menu', 'status'])
            ->toJson();
    }

    public function create()
    {
        $pic = Personal::where('kd_pat', '1E')
        	->where('employee_id', 'not like', "TX%")
            ->where("st", 1)
        	->orderBy('first_name')
        	->get()
        	->mapWithKeys(function($item){
                return [$item->employee_id => $item->full_name];
            })
            ->all();
        $pic = ["" => "Pilih PIC"] + $pic;
        return view('pages.permintaan-penawaran.create', [
            'pic' => $pic
        ]);
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        try {
            DB::beginTransaction();
                        
            Validator::make($request->all(), [
                'nama_proyek'   => 'required',
                'nama_pelanggan'=> 'required',
                'request_date'  => 'required',
                'due_date'  => 'required',
                'pic'           => 'required'
            ])->validate();

            $quoRequest = new QuotationRequest();
            $quoRequest->nama_proyek = $request->nama_proyek;
            $quoRequest->nama_pelanggan = $request->nama_pelanggan;
            $quoRequest->request_date = $request->request_date;
            $quoRequest->due_date = $request->due_date;
            $quoRequest->pic = $request->pic;
            $quoRequest->status = "baru";
            
            $quoRequest->save();

            DB::commit();

            $flasher->addSuccess('Data has been saved successfully!');
            return redirect()->route('permintaan-penawaran.index');
        } catch(Exception $e) {
            DB::rollback();
            
            $flasher->addError($e->getMessage());
            return redirect()->back();
        }
    }
}