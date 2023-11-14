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
            {!! Form::open(['url' => route('penawaran.store'), 'class' => 'form', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

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
                                <select class="form-control" id="no_surat" v-model="data.no_surat">
                                    <option  v-for="(row,idx) in dropdown.no_surat" :value="idx">@{{ row }}</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" v-model="data.nama_pelanggan" name="nama_pelanggan" class="form-control" id="nama_pelanggan">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" v-model="data.nama_perusahaan" name="nama_perusahaan" class="form-control" id="nama_perusahaan">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" v-model="data.no_hp" name="no_hp" class="form-control" id="no_hp">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Email</label>
                                <input type="text" v-model="data.email" name="email" class="form-control" id="email">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Proyek</label>
                                <input type="text" v-model="data.nama_proyek" name="" name="nama_proyek" class="form-control" id="nama_proyek">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Lokasi Proyek</label>
                                <select class="form-control" id="lokasi" v-model="data.lokasi">
                                    <option  v-for="(row,idx) in dropdown.lokasi" :value="idx">@{{ row }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Pabrik</label>
                                <select class="form-control" id="pabrik-angkutan">
                                    <option  v-for="(row,idx) in dropdown.pabrik" :value="idx + '#'  + row">@{{ row }}</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Kondisi Pengiriman</label>
                                <select class="form-control" id="kondisi" v-model="data.kondisi">
                                    <option  v-for="(row,idx) in dropdown.kondisi" :value="idx">@{{ row }}</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">PIC</label>
                                <select class="form-control" id="pic" v-model="data.pic">
                                    <option  v-for="(row,idx) in dropdown.pic" :value="idx">@{{ row }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">SE</label>
                                <select class="form-control" id="se" v-model="data.se">
                                    <option  v-for="(row,idx) in dropdown.se" :value="idx">@{{ row }}</option>
                                </select>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">SBU</label>
                                <select class="form-control" id="sbu" v-model="data.sbu">
                                    <option  v-for="(row,idx) in dropdown.sbu" :value="idx + '#'  + row">@{{ row }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ANGKUTAN -->
                <div class="card shadow-sm mb-3" v-show="data.kondisi == 'fot'">
                    <div class="card-header">
                        <h3 class="card-title">Angkutan</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Jenis Angkutan</label>
                            <select class="form-control" id="jenis_angkutan" v-model="data.kd_material">
                                <option  v-for="(row,idx) in dropdown.jenis_angkutan" :value="idx + '#'  + row">@{{ row }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Jarak</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="text" v-model="data.jarak" name="data.jarak" id="jarak" class="form-control jarak">
                                <span class="input-group-text" id="basic-addon2">Km</span>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Harga Angkutan</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="text" readonly v-model="data.harga_angkutan" name="harga_angkutan" id="harga_angkutan" class="form-control form-control-solid">
                                <span class="input-group-text" id="basic-addon2">Rp/Ton</span>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-5">
                            <a class="btn btn-primary" @click.prevent="showPrice()">@{{ btnLihatHarga }}</a>
                        </div>
                    </div>
                </div>

                <!-- INDEKS -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Indeks</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Cadangan HPP</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_cad_hpp" name="idx_cad_hpp" id="idx_cad_hpp" class="form-control currency">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Cadangan Transportasi</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_cad_transportasi" name="idx_cad_transportasi" id="idx_cad_transportasi" class="form-control currency">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Indeks Penawaran</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_hpju" name="idx_hpju" id="idx_hpju" class="form-control currency">
                                <span class="input-group-text" id="basic-addon2">%</span>
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
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Jenis</label>
                            <select class="form-control" id="tipe" v-model="data.tipe">
                                <option  v-for="(row,idx) in dropdown.tipe" :value="idx">@{{ row }}</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Tipe Produk</label>
                            <select class="form-control" name="tipe_produk" id="tipe_produk" v-model="data.tipe_produk"></select>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Volume</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="text" name="volume" id="volume" v-model="data.volume" class="form-control volume currency">
                                <span class="input-group-text" id="basic-addon2">Btg</span>
                            </div>
                        </div>
                        <div class="form-group mb-3 col-lg-6" v-show="data.tipe == 'NS'">
                            <label class="form-label">Satuan</label>
                            <input type="text" name="satuan" id="satuan" v-model="data.satuan" class="form-control satuan">
                        </div>
                        <div class="form-group mb-3 col-lg-6" v-show="data.tipe == 'NS'">
                            <label class="form-label">Harga Satuan</label>
                            <input type="text" name="harsat_manual" id="harsat_manual" v-model="data.harsat_manual" class="form-control harsat_manual currency">
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <button class="btn btn-success" @click.prevent="addProduk">@{{ btnAddProduct }}</button>
                        </div>

                        <table class="table table-row-bordered gy-5" width="100%">
                            <thead>
                                <tr class="fw-semibold fs-6">
                                    <th width="10%">&nbsp;No Produk</th>
                                    <th width="20%">Tipe Produk</th>
                                    <th width="5%">Volume (Btg)</th>
                                    <th width="5%">Satuan</th>
                                    <th width="10%">HPP</th>
                                    <th width="10%">Harga Transportasi</th>
                                    <th width="10%">Harga Jual</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, idx) in data.produk">
                                    <td>&nbsp;@{{ row.kd_produk }}</td>
                                    <td>@{{ row.tipe_produk}}</td>
                                    <td>@{{ row.volume }}</td>
                                    <td>@{{ row.satuan }}</td>
                                    <td>@{{ row.ket_harsat }}</td>
                                    <td>@{{ row.ket_transport }}</td>
                                    <td>@{{ row.ket_total }}</td>
                                    <td>
                                        <a href="javascript:void(0)" style="color: red;" @click.prevent="removeProduk(idx)">Hapus</a>&nbsp;
                                    </td>
                                </tr>

                                <tr class="text-dark-800 text-center" v-if="data.produk.length < 1">
                                    <td colspan="8">&nbsp;Produk Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- biaya umum pelaksanaan -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">BUP + BP</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="text" name="total" v-model="data.biaya_pelaksanaan" id="total" class="form-control total currency">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Preview Total -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Total Penawaran</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total Harga Jual</label>
                            <input type="text" name="ttl_h_jual" v-model="data.ttl_h_jual" id="ttl_h_jual" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total HPP</label>
                            <input type="text" name="ttl_hpp" v-model="data.ttl_hpp" id="ttl_hpp" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total Transportasi</label>
                            <input type="text" name="ttl_trans" v-model="data.ttl_trans" id="ttl_trans" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total BUP+BP</label>
                            <input type="text" name="ttl_bup_bp" v-model="data.ttl_bup_bp" id="ttl_bup_bp" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total LKB</label>
                            <input type="text" name="ttl_lkb" v-model="data.ttl_lkb" id="ttl_lkb" class="form-control" readonly>
                        </div>

                        <div class="card-footer" style="text-align: right;">
                            <button class="btn btn-success mr-2" @click.prevent="calculateTotal">@{{ btnCalculateTotal }}</button>
                            <a href="{{ route('penawaran.index') }}" class="btn btn-light btn-active-light-primary me-2">Kembali</a>

                            <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary" @click.prevent="onSubmit()">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
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
        data: {
            request_id: "{{ $permintaan->id ?? "" }}",
            no_surat:'',
            nama_pelanggan:"",
            nama_perusahaan:"{{ $permintaan->nama_pelanggan ?? "" }}",
            no_hp:'',
            email:'',
            nama_proyek:"{{ $permintaan->nama_proyek ?? "" }}",
            lokasi: '',
            kondisi: '',
            tipe: '',
            pic: '',
            se: '',
            sbu: '',
            ket_sbu:'',
            kd_produk: '',
            tipe_produk: '',
            pabrik: '',
            ket_pabrik: '',
            volume:'',
            harsat:'',
            harsat_manual:'',
            satuan:'',
            kd_material:'',
            ket_material:'',
            kd_pabrik:'',
            jarak:'',
            harga_angkutan:'',
            idx_cad_hpp:'',
            idx_cad_transportasi:'',
            idx_hpju:'',
            biaya_pelaksanaan:'',
            ttl_lkb:'',
            ttl_h_jual:'',
            ttl_hpp:'',
            ttl_trans:'',
            ttl_bup_bp:'',
            produk: {!! json_encode($produk) !!}
        },
        dropdown: {
            lokasi : {!! json_encode($lokasi) !!},
            kondisi : {!! json_encode($kondisi) !!},
            pic : {!! json_encode($se) !!},
            se : {!! json_encode($se) !!},
            sbu : {!! json_encode($sbu) !!},
            tipe : {!! json_encode($tipe) !!},
            pabrik : {!! json_encode($pabrik) !!},
            jenis_angkutan: {!! json_encode($jnsAngkutan) !!},
            no_surat: {!! json_encode($no_surat) !!}
        },
        btnAddProduct: 'Tambah Produk',
        btnLihatHarga: 'Lihat Harga',
        btnCalculateTotal: 'Hitung Total',
        select_tipe_produk: '',
        errors: []
    }
}
let app = new Vue({
    el: "#vue-app",
    data: function (){
        return initialState();
    },
    mounted: function() {
        this.$nextTick(this.initSelect2);

        let vm = this

        $("#harsat_manual").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.harsat_manual = val
        })

        $("#volume").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.volume = val
        })

        $("#idx_cad_hpp").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.idx_cad_hpp = val
        })
        $("#idx_cad_transportasi").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.idx_cad_transportasi = val
        })
        $("#idx_hpju").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.idx_hpju = val
        })
        $("#total").keyup(function() {
            var val = vm.thousandSeparator(this.value)

            this.value = val;
            vm.data.biaya_pelaksanaan = val
        })
    },
    methods: {
        initSelect2: function (e) {
            $("#lokasi").select2({
                placeholder: 'Pilih Lokasi'
            }).on('change', function () {
                app.data.lokasi = this.value;
            })

            $("#kondisi").select2({
                placeholder: 'Pilih Kondisi'
            }).on('change', function () {
                app.data.kondisi = this.value;
            })
            $("#tipe").select2({
                placeholder: 'Pilih Tipe'
            }).on('change', function () {
                app.data.tipe = this.value;
            })

            $("#pic").select2({
                placeholder: 'Pilih Pic'
            }).on('change', function () {
                app.data.pic = this.value;
            })
            $("#se").select2({
                placeholder: 'Pilih SE'
            }).on('change', function () {
                app.data.se = this.value;
            })

            $("#sbu").select2({
                placeholder: 'Pilih SBU'
            }).on('change', function () {
                let arrsbu = this.value.split("#")
                app.data.sbu = arrsbu[0]
                app.data.ket_sbu = arrsbu[1]
            })

            $("#pabrik").select2({
                placeholder: 'Pilih Pabrik'
            }).on('change', function () {
                let arrpabrik = this.value.split("#")
                app.data.pabrik = arrpabrik[0]
                app.data.ket_pabrik = arrpabrik[1]
            })

            $("#jenis_angkutan").select2({
                placeholder: 'Pilih Jenis Angkutan'
            }).on('change', function () {
                let arrmaterial = this.value.split("#")
                app.data.kd_material = arrmaterial[0]
                app.data.ket_material = arrmaterial[1]
            })
            $("#no_surat").select2({
                placeholder: 'Pilih No Surat'
            }).on('change', function () {
                app.data.no_surat = this.value
            })

            $("#pabrik-angkutan").select2({
                placeholder: 'Pilih Pabrik'
            }).on('change', function () {
                let arrpabrik = this.value.split("#")
                app.data.kd_pabrik = arrpabrik[0]
            })

            $('#tipe_produk').select2({
                placeholder: 'Cari...',
                ajax: {
                    url: "{{ route('penawaran.search-produk') }}",
                    minimumInputLength: 2,
                    dataType: 'json',
                    cache: true,
                    data: params => {
                        var query = {
                            search: params.term,
                            q: app.data.sbu,
                            type: 'public'
                        }

                        return query;
                    },
                    processResults: (data) => {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.tipe,
                                    id: item.kd_produk + '#' + item.tipe
                                }
                            })
                        };
                    },
                }
            })

            $("#tipe_produk").on("select2:select", function (e) {
                app.data.select_tipe_produk = $(e.currentTarget).val();
            });
        },
        addProduk: function() {
            let harsat = 10
            let total = 0
            let ton = 1
            let panjang = 1
            let vm = this
            vm.btnAddProduct = 'Menambahkan...'

            let arrtipe = vm.data.select_tipe_produk.split("#")
            vm.data.kd_produk = arrtipe[0]
            vm.data.tipe_produk = arrtipe[1]

            let tipe_produk = vm.data.tipe_produk
            var cad_hpp = 0;
            if(vm.data.idx_cad_hpp != ""){
                cad_hpp = parseInt(vm.data.idx_cad_hpp.toString().replace(/[^0-9\.]/g,'')) / 100;
            }
            var hpju = 1;
            if(vm.data.idx_hpju != ""){
                hpju = 1 - (parseInt(vm.data.idx_hpju.toString().replace(/[^0-9\.]/g,'')) / 100);
            }
            var cad_trans = 0;
            if(vm.data.idx_cad_transportasi != ""){
                cad_trans = (parseInt(vm.data.idx_cad_transportasi.toString().replace(/[^0-9\.]/g,'')) / 100);
            }
            // console.log(hpju)
            if(vm.data.tipe == 'S'){
                axios.get(
                    "{{ route('penawaran.harsat') }}" + "?kd_produk=" + vm.data.kd_produk + "&pat=" + vm.data.kd_pabrik
                ).then(response => {
                    panjang = parseInt(response.data.panjang)
                    ton = parseFloat(response.data.ton)
                    harsat = parseInt(response.data.nilai_hpp)
                    var h_trans = 0
                    if(vm.data.harga_angkutan != ""){
                        console.log(vm.data.harga_angkutan)
                        console.log(vm.data)
                        h_trans = parseInt(vm.data.harga_angkutan.toString().replace(/[^0-9\.]/g,''))
                        h_trans = h_trans + (h_trans * cad_trans);
                        h_trans = parseFloat((h_trans / ton).toFixed(0))
                    }
                    // console.log(h_trans)
                    harsat = harsat + (harsat * cad_hpp);
                    if(vm.data.sbu == 'B' || vm.data.sbu == 'E'){
                        harsat = parseFloat((harsat / panjang).toFixed(0))
                    }
                    total = harsat + h_trans
                    total = parseFloat((total / hpju).toFixed(0))

                    if(vm.data.sbu == 'A' || vm.data.sbu == 'F' || vm.data.sbu == 'F'){
                        var satuan_ = 'pcs'
                    }else{
                        var satuan_ = 'meter'
                    }
                    if(vm.data.tipe == 'NS'){
                        satuan_ = vm.data.satuan
                    }
                    let tmp = {
                        kd_produk : vm.data.kd_produk,
                        sbu: vm.data.sbu,
                        ket_sbu: vm.data.ket_sbu,
                        kd_produk: vm.data.kd_produk,
                        tipe_produk: tipe_produk,
                        // volume: vm.data.volume + ' ' + satuan_,
                        volume: vm.data.volume,
                        satuan: satuan_,
                        harsat: harsat,
                        transport: h_trans,
                        ket_transport: 'Rp. ' + vm.thousandSeparator(h_trans),
                        ket_harsat: 'Rp. ' + vm.thousandSeparator(harsat),
                        total: total,
                        ket_total: 'Rp. ' + vm.thousandSeparator(total)
                    }

                    vm.data.produk.push(tmp)
                    console.log(vm.data.produk)
                })

            }else{
                harsat = parseInt(vm.data.harsat_manual.toString().replace(/[^0-9\.]/g,''))
                var h_trans = 0
                if(vm.data.harga_angkutan != ""){
                    h_trans = parseInt(vm.data.harga_angkutan.toString().replace(/[^0-9\.]/g,''))
                    h_trans = h_trans + (h_trans * cad_trans);
                }
                harsat = harsat + (harsat * cad_hpp);
                total = harsat + h_trans
                total = parseFloat((total / hpju).toFixed(0))

                if(vm.data.sbu == 'A' || vm.data.sbu == 'F' || vm.data.sbu == 'F'){
                    var satuan_ = 'pcs'
                }else{
                    var satuan_ = 'meter'
                }
                if(vm.data.tipe == 'NS'){
                    satuan_ = vm.data.satuan
                }
                let tmp = {
                    kd_produk : vm.data.kd_produk,
                    sbu: vm.data.sbu,
                    ket_sbu: vm.data.ket_sbu,
                    kd_produk: vm.data.kd_produk,
                    tipe_produk: tipe_produk,
                    // volume: vm.data.volume + ' ' + satuan_,
                    volume: vm.data.volume,
                    satuan: satuan_,
                    harsat: harsat,
                    transport: h_trans,
                    ket_transport: 'Rp. ' + vm.thousandSeparator(h_trans),
                    ket_harsat: 'Rp. ' + vm.thousandSeparator(harsat),
                    total: total,
                    ket_total: 'Rp. ' + vm.thousandSeparator(total)
                }

                vm.data.produk.push(tmp)
            }

            vm.btnAddProduct = 'Tambah Produk'
        },
        removeProduk(idx) {
            app.data.produk.splice(idx, 1)
        },
        showPrice() {
            let vm = this
            app.btnLihatHarga = "Please wait..."
            axios.get(
                "{{ route('penawaran.harga') }}" + "?kd_material=" + app.data.kd_material + "&kd_pabrik=" + app.data.kd_pabrik + "&jarak=" + app.data.jarak
            ).then(response => {
                var res = response.data

                if (res.result == 'success') {
                    app.btnLihatHarga = "Lihat Harga"
                    app.data.harga_angkutan = vm.thousandSeparator(res.harga)
                }
            })
        },
        onSubmit() {
            $(".indicator-label").hide()
            $(".indicator-progress").show()

            axios.post(
            "{{ route('penawaran.store') }}", {
                maindata: app.data,
                detail_prd: app.detail
            })
            .then(resp => {
                let response = resp.data

                $(".indicator-label").show()
                $(".indicator-progress").hide()

                if (response.result == "success") {
                    flasher.success("Data has been saved successfully!")
                } else {
                    flasher.error("Oops! Something went wrong!")
                }
            })
            .catch(err => {
                $(".indicator-label").show()
                $(".indicator-progress").hide()

                flasher.error("Oops! Something went wrong!")
            })
            .finally(() => {
                setTimeout(() => {
                    this.reset()
                }, 2000)
            })
        },
        reset() {
            Object.assign(this.$data, initialState());
        },
        calculateTotal: function() {
            let vm = this
            let ttl = 0
            let t_lkb = 0
            let t_h_jual = 0
            let t_hpp = 0
            let t_trans = 0
            let t_bup_bp = 0
            app.btnAddProduct = 'Menghitung...'

            var cad_hpp = 0;
            if(app.data.idx_cad_hpp != ""){
                cad_hpp = parseInt(app.data.idx_cad_hpp.toString().replace(/[^0-9\.]/g,'')) / 100;
            }
            var cad_trans = 0;
            if(app.data.idx_cad_transportasi != ""){
                cad_trans = (parseInt(app.data.idx_cad_transportasi.toString().replace(/[^0-9\.]/g,'')) / 100);
            }

            for (produk of app.data.produk) {
                var vol_prod = produk.volume.toString().replace(/[^0-9\.]/g,'')
                t_h_jual += parseFloat(produk.total) * vol_prod
                t_hpp += parseFloat((produk.harsat/(1+cad_hpp)).toFixed(0)) * vol_prod
                t_trans += parseFloat((produk.transport/(1+cad_trans)).toFixed(0)) * vol_prod
                ttl += parseFloat(produk.total) * vol_prod
            }
            if(app.data.biaya_pelaksanaan != ""){
                t_bup_bp = (parseInt(app.data.biaya_pelaksanaan.replace(".", "")) * ttl / 100)
                ttl = ttl + t_bup_bp
            }
            t_lkb = ((t_h_jual - t_hpp - t_trans - t_bup_bp) / t_h_jual * 100).toFixed(2)
            app.data.total_penawaran = vm.thousandSeparator(total)
            app.data.ttl_h_jual = vm.thousandSeparator(t_h_jual)
            app.data.ttl_hpp = vm.thousandSeparator(t_hpp)
            app.data.ttl_trans = vm.thousandSeparator(t_trans)
            app.data.ttl_bup_bp = vm.thousandSeparator(t_bup_bp)
            app.data.ttl_lkb = t_lkb + "%"
            app.btnAddProduct = 'Hitung Total'
        },
        thousandSeparator(val){
            val = val.toString().replace(/[^0-9\.]/g,'');

            if(val != "") {
                valArr = val.toString().split('.');
                valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
                val = valArr.join('.');
            }

            return val
        },
    }
})
</script>
@endsection
