<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        return DataTables::eloquent($query)->toJson();
    }

    public function create()
    {
        return view('pages.permintaan-penawaran.create');
    }

    public function store(Request $request, FlasherInterface $flasher)
    {
        try {
            DB::beginTransaction();
                        
            Validator::make($request->all(), [
                'nama_proyek'   => 'required',
                'nama_pelanggan'=> 'required',
                'request_date'  => 'required',
                'pic'           => 'required'
            ])->validate();

            $quoRequest = new QuotationRequest();
            $quoRequest->nama_proyek = $request->nama_proyek;
            $quoRequest->nama_pelanggan = $request->nama_pelanggan;
            $quoRequest->request_date = $request->request_date;
            $quoRequest->pic = $request->pic;
            
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