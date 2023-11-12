<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Internal\SptbListResource;
use App\Http\Resources\Pelanggan\PelangganResource;
use App\Http\Resources\QuotationDetailResource;
use App\Http\Resources\QuotationResource;
use App\Models\Pelanggan;
use App\Models\PelangganUser;
use App\Models\Quotation;
use App\Models\SptbD2;
use App\Models\SptbH;
use App\Services\KalenderService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Throwable;

class PenawaranController extends Controller
{

    public function index(Request $request)
    {
        $perPage = !empty($request->perpage) ? $request->perpage : 20;

    	$data = Quotation::select('*')->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $data->where(DB::raw("LOWER(no_surat)"), 'like', '%' . strtolower($request->search) . '%');
        }

        return QuotationResource::collection($data->paginate($perPage)->appends($request->except(['page','_token'])), "minimal")->additional([
            'meta' => [
                'menu' => [
                    "show",
                    "nego",
                ]
            ]
        ]);
    }

    public function show(Request $request)
    {
        $data = Quotation::with('produk', 'pabrik', 'getsbu', 'getpic')->find($request->id);

        return new QuotationDetailResource($data);
    }

    public function approvalList(Request $request)
    {
        $perPage = !empty($request->perpage) ? $request->perpage : 20;

    	$data = Quotation::select('*')->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $data->where(DB::raw("LOWER(no_surat)"), 'like', '%' . strtolower($request->search) . '%');
        }
        if($request->type == 'approval1'){
            $data->where('app1', 0);
        }
        if($request->type == 'approval2'){
            $data->where('app1', 1)->where('app2', 0);
        }

        return QuotationResource::collection($data->paginate($perPage)->appends($request->except(['page','_token'])), "minimal");
    }

    public function approve(Request $request)
    {
        $data = Quotation::find($request->id);
        
        if($request->type == 'approval1'){
            $data->app1 = 1;
        }
        if($request->type == 'approval2'){
            $data->app1 = 1;
        }

        return response()->json([
            'status' => "success",
            'message' => "success"
        ]);
    }
}

