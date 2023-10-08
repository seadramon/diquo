<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pat;
use App\Models\Personal;
use App\Models\PricelistAngkutanD;
use App\Models\Region;
use App\Models\Views\VMasterProduk;

use DB;

class PenawaranController extends Controller
{
    //
    public function index(Request $request)
    {
    	$lokasi = Region::get()
            ->mapWithKeys(function($item){
                return [$item->kd_region => $item->propinsi_name];
            })
            ->all();

        $kondisi = [
        	"" => "Pilih Kondisi",
        	"loko" => 'loko',
        	"fot" => 'fot'
        ];

        $pic = Personal::where('kd_pat', '1E')
        	->where('employee_id', 'not like', "TX%")
        	->orderBy('first_name')
        	->get()
        	->mapWithKeys(function($item){
                return [$item->employee_id => $item->full_name];
            })
            ->all();
        $pic = ["" => "Pilih PIC"] + $pic;

        $sbu = VMasterProduk::select(DB::raw("distinct kd_sbu, singkatan2||' - '||nama_sbu as sbu"))
        	->where('std_nonstd', 'S')
        	->orderBy('kd_sbu')
        	->get()
        	->mapWithKeys(function($item){
                return [$item->kd_sbu => $item->sbu];
            })
            ->all();
        $sbu = ["" => "Pilih SBU"] + $sbu;

        $pabrik = Pat::whereIn(DB::raw('SUBSTR(KD_PAT, 1, 1)'), ['2'])
        	->get()
        	->mapWithKeys(function($item){
                return [$item->kd_pat => $item->ket];
            })
            ->all();
        $pabrik = ["" => "Pilih Pabrik"] + $pabrik;

        $jnsAngkutan = PricelistAngkutanD::select(DB::raw("distinct tr_material.kd_material, tr_material.uraian, tr_material.spesifikasi"))
        	->join('tr_material', 'tms_pricelist_angkutan_d.kd_material', '=', 'tr_material.kd_material')
        	->get()
        	->mapWithKeys(function($item){
                return [$item->kd_material => $item->uraian .' - '.$item->spesifikasi];
            })
            ->all();
        $jnsAngkutan = ["" => "Pilih Jenis Angkutan"] + $jnsAngkutan;

        $produk = [];

    	return view('pages.penawaran.index', compact('lokasi', 
    		'kondisi', 
    		'pic', 
    		'sbu', 
    		'jnsAngkutan', 
    		'pabrik',
    		'produk'));
    }

    public function store(Request $request)
    {
    	dd($request->All());
    	try {
            $data = StudentKlass::where('klass_id', $request->klass_id)->forceDelete();

            foreach ($request->students as $row) {
                $studentclass = new StudentKlass;

                $studentclass->student_id = $row['id'];
                $studentclass->klass_id = $request->klass_id;

                $studentclass->save();
            }
            
            return response()->json(['result' => 'success']);
        } catch (Exception $e) {            
            Log::error('Error - Save data Student Class '.$e->getMessage());

            return response()->json(['result' => 'failed']);
        }
    }

    public function getProduk(Request $request)
    {
    	$sbu = $request->q;
    	$search = $request->search;
    	$result = null;

    	if ($sbu) {
	    	$data = VMasterProduk::select('kd_produk', 'tipe')
	    		->where('std_nonstd', 'S')
	    		->where('kd_sbu', $sbu)
	    		->where('aktif', 'Y');

	    	if ($search) {
	    		$data->where('tipe', 'LIKE', '%'. $search . '%');
	    	}

	    	$result = $data->get();
	    }

    	return $result;
    }

    public function getHarsat(Request $request)
    {
    	$kd_produk = $request->kd_produk;
    	$pat = $request->pat;

    	$params = [
    		'kd_produk' => $kd_produk
    	];

    	$sql = "
    		SELECT 
				FNC_COUNT_HPPS ( :kd_produk, '2C', (SELECT TRIM (fnc_get_tri_rev_hpps (SYSDATE, 'TRI')) FROM DUAL), 
				(SELECT TRIM (fnc_get_tri_rev_hpps (SYSDATE, 'REV')) FROM DUAL), 0)nilai_hpp 
			FROM 
				DUAL
    	";

    	$data = collect(
    		DB::select($sql, $params)
    	)->first();

    	return $data;
    }
}
