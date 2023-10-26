@extends('layout.layout2')

@section('page-title')
<!--begin::Page title-->
<div class="page-title d-flex justify-content-center flex-column me-5">
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Form Penawaran</h1>
</div>
<!--end::Page title-->
@endsection

@section('content')
<!--begin::Content container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Row-->
    <div class="row g-5 g-xl-8" id="vue-app" v-cloak>
        <!--begin::Col-->
        <div class="col-12 mb-md-5 mb-xl-10">

                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Data Proyek</h3>
                    </div>
                
                    <div class="card-body">
                        @if (count($errors) > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endforeach
                        @endif

                        <div class="row">
                            <div class="form-group mb-3 col-lg-12">
                                <label class="form-label">Nomor Surat</label>
                                <input type="text" readonly name="no_surat" id="no_surat" class="form-control form-control-solid no_surat w-50" value="{{ $data->no_surat }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" readonly name="nama_pelanggan" class="form-control form-control-solid" id="nama_pelanggan" value="{{ $data->nama_pelanggan }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" readonly name="nama_perusahaan" class="form-control form-control-solid" id="nama_perusahaan" value="{{ $data->nama_perusahaan }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" readonly name="no_hp" class="form-control form-control-solid" id="no_hp" value="{{ $data->no_hp }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Email</label>
                                <input type="text" readonly name="email" class="form-control form-control-solid" id="email" value="{{ $data->email }}">
                            </div>

                            <div class="form-group mb-3 col-lg-12">
                                <label class="form-label">Nama Proyek</label>
                                <input type="text" readonly name="" name="nama_proyek" class="form-control form-control-solid" id="email"  value="{{ $data->nama_proyek }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Lokasi Proyek</label>
                                <input type="text" readonly name="lokasi_proyek" class="form-control form-control-solid" id="email"  value="{{ $data->lokasi_proyek }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Kondisi Pengiriman</label>
                                <input type="text" readonly name="kondisi" class="form-control form-control-solid" id="kondisi" value="{{ $data->kondisi_pengiriman }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">PIC</label>
                                <input type="text" readonly name="pic" class="form-control form-control-solid" id="pic"  value="{{ !empty($data->getpic)?$data->getpic->full_name:'-' }}">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">SBU</label>
                                <input type="text" readonly name="sbu" class="form-control form-control-solid" id="sbu"  value="{{ !empty($data->getsbu)?$data->getsbu->singkatan2.' - '.$data->getsbu->nama_sbu:'' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DETAIL PRODUK -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Detail Produk</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-row-bordered gy-5" width="100%">
                            <thead>
                                <tr class="fw-semibold fs-6">
                                    <th width="15%">&nbsp;No Produk</th>
                                    <th width="40%">SBU</th>
                                    <th width="20%">Tipe Produk</th>
                                    <th width="5%">Volume</th>
                                    <th width="10%">HPP</th>
                                    <th width="10%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($data->produk) > 0)
                                    @foreach($data->produk as $row)
                                        <tr>
                                            <td>&nbsp;{{ $row->kd_produk }}</td>
                                            <td>{{ !empty($row->getsbu)?$row->getsbu->singkatan2.' - '.$row->getsbu->nama_sbu:'' }}</td>
                                            <td>{{ $row->tipe_produk}}</td>
                                            <td>{{ $row->volume }}</td>
                                            <td>{{ 'Rp. '.$row->harsat_produk }}</td>
                                            <td>{{ 'Rp. '.$row->total }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-muted" v-if="data.produk.length < 1">
                                        <td colspan="6">&nbsp;Produk Kosong</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ANGKUTAN -->
                @if ($data->kondisi_pengiriman == 'fot')
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Angkutan</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group mb-3 col-lg-12">
                                <label class="form-label">Jenis Angkutan</label>
                                <input type="text" readonly name="ket_material" class="form-control form-control-solid" id="ket_material" value="{{ $data->ket_material }}">
                            </div>

                            <div class="form-group mb-3 col-lg-12">
                                <label class="form-label">Pabrik</label>
                                <input type="text" readonly name="kd_pabrik" class="form-control form-control-solid" id="kd_pabrik" value="{{ $data->pabrik->ket }}">
                            </div>

                            <div class="form-group mb-3 col-lg-12">
                                <label class="form-label">Jarak</label>
                                <input type="text" readonly name="jarak" id="jarak" class="form-control form-control-solid jarak" value="{{ $data->jarak }}">
                            </div>

                            <div class="form-group mb-3 col-lg-7 ">
                                <label class="form-label">Harga Angkutan</label>
                                <input type="text" readonly name="harga_angkutan" id="harga_angkutan" class="form-control form-control-solid" value="{{ $data->harga_angkutan }}">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- INDEKS -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Indeks</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks Cadangan HPP</label>
                            <input type="number" readonly value="{{ $data->idx_cad_hpp }}" name="idx_cad_hpp" id="idx_cad_hpp" class="form-control form-control-solid">
                        </div>

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks Cadangan Transportasi</label>
                            <input type="number" readonly value="{{ $data->idx_cad_transportasi }}" name="idx_cad_transportasi" id="idx_cad_transportasi" class="form-control form-control-solid">
                        </div>

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks HPJu</label>
                            <input type="number" readonly value="{{ $data->idx_hpju }}" name="idx_hpju" id="idx_hpju" class="form-control form-control-solid">
                        </div>
                    </div>
                </div>

                <!-- biaya umum pelaksanaan -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Biaya Umum Pelaksanaan</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Total</label>
                            <input type="number" readonly name="total" value="{{ $data->biaya_pelaksanaan }}" id="total" class="form-control form-control-solid total">
                        </div>

                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('penawaran.index') }}" class="btn btn-light btn-active-light-primary me-2">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Content container-->
@endsection

@section('css')
<style type="text/css">
    .table {
  border: 1px solid black;
  width: 100%;
}

.table thead th {
  border-top: 1px solid #000!important;
  border-bottom: 1px solid #000!important;
  border-left: 1px solid #000;
  border-right: 1px solid #000;
}

.table td {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
  border-top: none!important;
}
</style>
@endsection

@section('js')

@if(App::environment('production'))
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
@else
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
@endif
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
<script type="text/javascript">
function initialState (){
    return {
        data: {},
        errors: []
    }
}
let app = new Vue({
    el: "#vue-app",
    data: function (){
        return initialState();
    },
    mounted: function() {
    },
    methods: {
        
    }
})
</script>
@endsection