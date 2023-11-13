<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pat;
use App\Models\Personal;
use App\Models\Region;
use App\Models\VMasterProduk;

use App\Models\Quotation;
use App\Models\QuotationProduk;
use App\Models\PricelistAngkutanD;
use App\Models\PricelistAngkutanD2;
use App\Models\Produk;
use App\Models\QuotationRequest;
use App\Models\TbSurat;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;

class PenawaranController extends Controller
{
    public function index(){
        return view('pages.penawaran.index');
    }

    public function data()
    {
        $query = Quotation::select('*')->orderBy('created_at', 'desc');

        return DataTables::eloquent($query)
            ->addColumn('menu', function ($model) {
                $column = '<div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('penawaran.show', $model->id) . '">Show</a></li>
							<li><a class="dropdown-item" href="' . route('penawaran.nego', ['id' => $model->id]) . '" target="_blank">Nego</a></li>
                            <li><a class="dropdown-item" href="' . route('penawaran.print', ['id' => $model->id]) . '" target="_blank">Cetak</a></li>
                        </ul>
                        </div>';

                return $column;
            })
            ->editColumn('created_at', function($model) {
                $edit = date('d F Y', strtotime($model->created_at));

                return $edit;
            })
            ->editColumn('sbu', function($model) {
                $edit = !empty($model->getsbu)?$model->getsbu->singkatan2.' - '.$model->getsbu->nama_sbu:'-';

                return $edit;
            })
            ->editColumn('pic', function($model) {
                $edit = !empty($model->getpic)?$model->getpic->full_name:'-';

                return $edit;
            })
            // ->addColumn('approval_status', function($model) {
            //     $edit = !empty($model->getpic)?$model->getpic->full_name:'-';

            //     return $edit;
            // })
            ->rawColumns(['menu'])
            ->toJson();
    }

    public function show($id)
    {
        $data = Quotation::find($id);
        $produk = [];

        if (count($data->produk) > 0) {
            // dd($data->produk);
            foreach ($data->produk as $row) {
                $produk[] = [
                    'kd_produk' => $row->kd_produk,
                    'tipe_produk' => $row->tipe_produk,
                    'volume' => $row->volume,
                    'total' => $row->total,
                    'harsat' => $row->harsat_produk,
                    'transport' => $row->transportasi,
                    'sbu' => $row->sbu
                ];
            }
        }

        return view('pages.penawaran.show', compact('data', 'produk'));
    }

    public function create(Request $request)
    {
		$permintaan = null;
		if($request->has('request_id')){
			$permintaan = QuotationRequest::find($request->request_id);
		}
    	$lokasi = Region::select('kabupaten_name')
    		->groupBy('kabupaten_name')
    		->get()
            ->mapWithKeys(function($item){
                return [$item->kabupaten_name => $item->kabupaten_name];
            })
            ->all();

        $kondisi = [
        	"" => "Pilih Kondisi",
        	"loko" => 'LOKO',
        	"fot" => 'FOT'
        ];
        $tipe = [
        	"S" => "Standard",
        	"NS" => "Non Standard",
        ];

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

        $se = Personal::where('kd_pat', '1E')
        	->where('employee_id', 'not like', "TX%")
        	->where('kd_jbt', 'JBTS0001')
            ->where("st", 1)
        	->orderBy('first_name')
        	->get()
        	->mapWithKeys(function($item){
                return [$item->employee_id => $item->full_name];
            })
            ->all();
        $se = ["" => "Pilih SE"] + $se;

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

		$no_surat = TbSurat::where('no_surat', 'LIKE', 'PS.03.03%')
			->where('kd_pat_pengirim', '1E')
			->get()
		// $no_surat = TbSurat::all()
			->mapWithKeys(function($item){
                return [$item->no_surat => $item->no_surat];
            })
            ->all();

    	return view('pages.penawaran.create', compact('lokasi',
    		'kondisi',
    		'pic',
    		'se',
    		'tipe',
    		'sbu',
    		'jnsAngkutan',
    		'pabrik',
    		'produk',
    		'no_surat',
    		'permintaan'));
    }

    public function store(Request $request)
    {
		// return response()->json($request->all());
    	try {
    		DB::beginTransaction();

    		$main = $request['maindata'];
            $data = new Quotation;

            $data->no_surat = $main['no_surat'] . "P00";
		  	$data->nama_pelanggan = $main['nama_pelanggan'];
		  	$data->nama_perusahaan = $main['nama_perusahaan'];
		  	$data->no_hp = $main['no_hp'];
		  	$data->email = $main['email'];
		  	$data->nama_proyek = $main['nama_proyek'];
		  	$data->lokasi_proyek = $main['lokasi'];
		  	$data->kondisi_pengiriman = $main['kondisi'];
		  	$data->pic = $main['pic'];
		  	$data->se_id = $main['se'];
		  	$data->sbu = $main['sbu'];
		  	// angkutan
		  	$data->kd_material = isset($main['kd_material'])?$main['kd_material']:null;
		  	$data->ket_material = isset($main['ket_material'])?$main['ket_material']:null;
		  	$data->kd_pabrik = isset($main['kd_pabrik'])?$main['kd_pabrik']:null;
		  	$data->jarak = isset($main['jarak'])?$main['jarak']:null;
		  	$data->harga_angkutan = isset($main['harga_angkutan'])? str_replace(',', '', $main['harga_angkutan']):0;
		  	// index
		  	$data->idx_cad_hpp = str_replace(',', '', $main['idx_cad_hpp']);
		  	$data->idx_cad_transportasi = str_replace(',', '', $main['idx_cad_transportasi']);
		  	$data->idx_hpju = str_replace(',', '', $main['idx_hpju']);
		  	// biaya
		  	$data->biaya_pelaksanaan = !empty($main['biaya_pelaksanaan'])?str_replace(".", "", $main['biaya_pelaksanaan']):0;
            $data->status = "penawaran";
		  	$data->save();
		  	$id = $data->id;

		  	if (count($request['maindata']['produk']) > 0) {
		  		$details = $request['maindata']['produk'];

	            foreach ($details as $row) {
	                $produk = new QuotationProduk;

	                $produk->quotation_id = $id;
	                $produk->sbu = $row['sbu'];
	                $produk->kd_produk = $row['kd_produk'];
	                $produk->tipe_produk = $row['tipe_produk'];
                    $produk->harsat_produk = str_replace(',', '', $row['harsat']);
                    $produk->transportasi = str_replace(',', '', $row['transport']);
                    $produk->volume = str_replace(',', '', $row['volume']);
                    $produk->total = str_replace(',', '', $row['total']);

	                $produk->save();
	            }
		  	}

			if($main['request_id']){
				$permintaan = QuotationRequest::find($main['request_id']);
				$permintaan->status = 'selesai';
				$permintaan->save();
			}

            DB::commit();

            return response()->json(['result' => 'success']);
        } catch (Exception $e) {
        	DB::rollback();
            Log::error('Error - Gagal simpan data Penawaran '.$e->getMessage());

            return response()->json(['result' => 'failed | ' . $e->getMessage()]);
        }
    }

    public function getProduk(Request $request)
    {
    	$sbu = $request->q;
    	$search = $request->search;
    	$result = null;

    	if ($sbu) {
	    	$data = VMasterProduk::select('kd_produk', DB::raw("KD_PRODUK || ' - ' || TIPE || ' [' || (CASE WHEN STD_NONSTD = 'S' THEN 'STD' ELSE 'NONSTD' END) || ']' as tipe"))
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
        $produk = Produk::find($kd_produk);

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

    	// return $data;
    	return response()->json([
            "nilai_hpp" => $data->nilai_hpp ?? 0,
            "ton" => ($produk->kg ?? 1000) / 1000,
            "panjang" => $produk->panjang ?? 1,
        ]);
    	// return response()->json(['nilai_hpp' => 15000]);
    }

    public function getHarga(Request $request)
    {
        $harga = PricelistAngkutanD2::where('range_min', '<=', $request->jarak)
            ->where('range_max', '>=', $request->jarak)
            ->whereHas('pad', function($sql) use ($request) {
                $sql->where('kd_material', $request->kd_material);
                $sql->where('kd_muat', $request->kd_pabrik);
            })
            ->first();
    	return response()->json(['result' => 'success', 'harga' => $harga->h_final ?? '0']);
    }

	public function cetak($id)
    {
        // dd('test');
        $pdf = Pdf::loadView('prints.penawaran');

        $filename = "Penawaran";

        return $pdf->setPaper('a4', 'portrait')
            ->stream($filename . '.pdf');
    }

    public function nego($id)
    {
        $data = Quotation::find($id);
        $produk = [];

        if (count($data->produk) > 0) {
            // dd($data->produk);
            foreach ($data->produk as $row) {
                $produk[] = [
                    'kd_produk' => $row->kd_produk,
                    'tipe_produk' => $row->tipe_produk,
                    'volume' => $row->volume,
                    'total' => $row->total,
                    'harsat' => $row->harsat_produk,
                    'transport' => $row->transportasi,
                    'sbu' => $row->sbu
                ];
            }
        }

        return view('pages.penawaran.nego', compact('data', 'produk'));
    }

    public function storeNego(Request $request)
    {
        try {
            DB::beginTransaction();

            $main = $request['maindata'];
            $data = Quotation::find($main['request_id']);

            $newdata = $data->replicate();

            $no_surat = $newdata->no_surat;
            $no_baru = intval(substr($no_surat, -2)) + 1;
            $newdata->no_surat = substr($no_surat, 0, strlen($no_surat) - 3) . "P". sprintf('%02d', $no_baru);

            $newdata->parent_id = $data->id;
            $newdata->save();
            $id = $newdata->id;

            $data->status = "revised";
            $data->save();

            if (count($request['maindata']['produk']) > 0) {
                $details = $request['maindata']['produk'];

                foreach ($details as $row) {
                    $produk = new QuotationProduk;

                    $produk->quotation_id = $id;
                    $produk->sbu = $row['sbu'];
                    $produk->kd_produk = $row['kd_produk'];
                    $produk->tipe_produk = $row['tipe_produk'];
                    $produk->harsat_produk = str_replace(',', '', $row['harsat']);
                    $produk->transportasi = str_replace(',', '', $row['transport']);
                    $produk->volume = str_replace(',', '', $row['volume']);
                    $produk->total = str_replace(',', '', $row['total']);

                    $produk->save();
                }
            }

            DB::commit();

            return response()->json(['result' => 'success']);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error - Gagal simpan data Penawaran '.$e->getMessage());

            return response()->json(['result' => 'failed | ' . $e->getMessage()]);
        }
    }
}
