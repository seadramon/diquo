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
                                <input type="text" v-model="data.no_surat" name="no_surat" class="form-control form-control-solid" id="no_surat" readonly>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Pelanggan</label>
                                <input type="text" v-model="data.nama_pelanggan" name="nama_pelanggan" class="form-control form-control-solid" readonly id="nama_pelanggan">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Perusahaan</label>
                                <input type="text" v-model="data.nama_perusahaan" name="nama_perusahaan" class="form-control form-control-solid" readonly id="nama_perusahaan">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" v-model="data.no_hp" name="no_hp" class="form-control form-control-solid" readonly id="no_hp">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Email</label>
                                <input type="text" v-model="data.email" name="email" class="form-control form-control-solid" id="email" readonly>
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Nama Proyek</label>
                                <input type="text" v-model="data.nama_proyek" name="" name="nama_proyek" class="form-control form-control-solid" readonly id="nama_proyek">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Lokasi Proyek</label>
                                <input type="text" v-model="data.lokasi" name="" name="lokasi" class="form-control form-control-solid" readonly id="lokasi">
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Pabrik</label>
                                <input type="text" v-model="data.kd_pabrik" name="kd_pabrik" class="form-control form-control-solid" readonly id="kd_pabrik">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">Kondisi Pengiriman</label>
                                <input type="text" v-model="data.kondisi" name="" name="kondisi" class="form-control form-control-solid" readonly id="kondisi">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">PIC</label>
                                <input type="text" v-model="data.pic" name="" name="pic" class="form-control form-control-solid" readonly id="pic">
                            </div>
                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">SE</label>
                                <input type="text" v-model="data.se" name="" name="se" class="form-control form-control-solid" readonly id="se">
                            </div>

                            <div class="form-group mb-3 col-lg-6">
                                <label class="form-label">SBU</label>
                                <input type="text" v-model="data.sbu" name="" name="sbu" class="form-control form-control-solid" readonly id="sbu">
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
                            <input type="text" v-model="data.kd_material" name="data.kd_material" id="kd_material" class="form-control jarak form-control-solid" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-16">
                            <label class="form-label">Jarak</label>
                            <input type="text" v-model="data.jarak" name="data.jarak" id="jarak" class="form-control jarak form-control-solid" readonly>
                        </div>

                        <div class="form-group mb-3 col-lg-6 ">
                            <label class="form-label">Harga Angkutan</label>
                            <input type="text" readonly v-model="data.harga_angkutan" name="harga_angkutan" id="harga_angkutan" class="form-control form-control-solid" >
                        </div>
                        <!-- <div class="mb-3 col-lg-5">
                            <a class="btn btn-primary" @click.prevent="showPrice()" disabled>@{{ btnLihatHarga }}</a>
                        </div> -->
                    </div>
                </div>

                <!-- INDEKS -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Indeks</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Indeks Cadangan HPP</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_cad_hpp" name="idx_cad_hpp" id="idx_cad_hpp" class="form-control currency form-control-solid" readonly>
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Indeks Cadangan Transportasi</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_cad_transportasi" name="idx_cad_transportasi" id="idx_cad_transportasi" class="form-control currency form-control-solid" readonly>
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>

                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Indeks HPJu</label>
                            <div class="input-group mb-3 col-lg-12">
                                <input type="number" v-model="data.idx_hpju" name="idx_hpju" id="idx_hpju" class="form-control currency form-control-solid" readonly>
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
                        <table class="table table-row-bordered gy-5" width="100%">
                            <thead>
                                <tr class="fw-semibold fs-6">
                                    <th width="10%">&nbsp;No Produk</th>
                                    <th width="20%">Tipe Produk</th>
                                    <th width="10%">Volume</th>
                                    <th width="5%">Satuan</th>
                                    <th width="10%">HPP</th>
                                    <th width="10%">Harga Transportasi</th>
                                    <th width="10%">Harga Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="data.produk.length > 0" v-for="(row, idx) in data.produk">
                                    <tr>
                                        <td>&nbsp;@{{ row.kd_produk }}</td>
                                        <td>@{{ row.tipe_produk }}</td>
                                        <td>@{{ row.volume }}</td>
                                        <td>&nbsp;</td>
                                        <td>@{{ 'Rp. ' + thousandSeparator(row.harsat) }}</td>
                                        <td>@{{ 'Rp. ' + thousandSeparator(row.transport) }}</td>
                                        <td>@{{ 'Rp. ' + thousandSeparator(row.total) }}</td>
                                    </tr>    
                                </template>
                                <tr v-if="data.produk.length == 0">
                                    <td class="text-center" colspan="7">No result</td>
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
                                <input type="text" name="total" v-model="data.biaya_pelaksanaan" id="total" class="form-control total currency form-control-solid" readonly>
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
                            <input type="text" name="ttl_h_jual" v-model="data.ttl_h_jual" id="ttl_h_jual" class="form-control form-control-solid" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total HPP</label>
                            <input type="text" name="ttl_hpp" v-model="data.ttl_hpp" id="ttl_hpp" class="form-control form-control-solid" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total Transportasi</label>
                            <input type="text" name="ttl_trans" v-model="data.ttl_trans" id="ttl_trans" class="form-control form-control-solid" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total BUP+BP</label>
                            <input type="text" name="ttl_bup_bp" v-model="data.ttl_bup_bp" id="ttl_bup_bp" class="form-control form-control-solid" readonly>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Total LKB</label>
                            <input type="text" name="ttl_lkb" v-model="data.ttl_lkb" id="ttl_lkb" class="form-control form-control-solid" readonly>
                        </div>
                        
                        {{-- <label for="diskon" class="form-label">Diskon</label>
                        <div class="input-group mb-3 col-lg-6">
                            <input type="number" name="diskon" v-model="data.diskon" id="diskon" class="form-control" aria-label="User Discount" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div> --}}

                        <div class="card-footer" style="text-align: right;">
                            {{-- <button class="btn btn-success mr-2" @click.prevent="calculateTotal">@{{ btnCalculateTotal }}</button> --}}
                            <a href="{{ route('penawaran.index') }}" class="btn btn-light btn-active-light-primary me-2">Kembali</a>

                            {{-- <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary" @click.prevent="onSubmit()">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button> --}}
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
            request_id: "{{ $data->id ?? "" }}",
            no_surat:"{{ $data->no_surat }}",
            nama_pelanggan:"{{ $data->nama_pelanggan ?? "" }}",
            nama_perusahaan:"{{ $data->nama_perusahaan }}",
            no_hp:"{{ $data->no_hp }}",
            email:"{{ $data->email }}",
            nama_proyek:"{{ $data->nama_proyek ?? "" }}",
            lokasi: "{{ $data->lokasi_proyek }}",
            kondisi: "{{ $data->kondisi_pengiriman }}",
            tipe: '',
            pic: "{{ !empty($data->getpic)?$data->getpic->full_name:'-' }}",
            se: "{{ !empty($data->getse)?$data->getse->full_name:'-' }}",
            sbu: "{{ !empty($data->getsbu)?$data->getsbu->singkatan2.' - '.$data->getsbu->nama_sbu:'' }}",
            ket_sbu:'',
            kd_produk: '',
            tipe_produk: '',
            pabrik: '',
            ket_pabrik: '',
            volume:'',
            harsat:'',
            harsat_manual:'',
            satuan:'',
            kd_material:"{{ $data->ket_material }}",
            ket_material:'',
            kd_pabrik:"{{ $data->pabrik->ket }}",
            jarak:"{{ $data->jarak }}",
            harga_angkutan: "{{ $data->harga_angkutan }}",
            idx_cad_hpp:"{{ $data->idx_cad_hpp }}",
            idx_cad_transportasi:"{{ $data->idx_cad_transportasi }}",
            idx_hpju:"{{ $data->idx_hpju }}",
            biaya_pelaksanaan:"{{ $data->biaya_pelaksanaan }}",
            ttl_lkb:'',
            ttl_h_jual:'',
            ttl_hpp:'',
            ttl_trans:'',
            ttl_bup_bp:'',
            diskon:0,
            produk: {!! json_encode($produk) !!}
        },
        dropdown: {
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

        this.calculateTotal()

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

            
        },
        addProduk: function() {
            let harsat = 10
            let total = 0
            let kg = 1
            let panjang = 1
            let vm = this
            app.btnAddProduct = 'Menambahkan...'

            let arrtipe = app.data.select_tipe_produk.split("#")
            app.data.kd_produk = arrtipe[0]
            app.data.tipe_produk = arrtipe[1]

            let tipe_produk = app.data.tipe_produk
            var cad_hpp = 0;
            if(app.data.idx_cad_hpp != ""){
                cad_hpp = parseInt(app.data.idx_cad_hpp.toString().replace(/[^0-9\.]/g,'')) / 100;
            }
            var hpju = 1;
            if(app.data.idx_hpju != ""){
                hpju = 1 - (parseInt(app.data.idx_hpju.toString().replace(/[^0-9\.]/g,'')) / 100);
            }
            var cad_trans = 0;
            if(app.data.idx_cad_transportasi != ""){
                cad_trans = (parseInt(app.data.idx_cad_transportasi.toString().replace(/[^0-9\.]/g,'')) / 100);
            }
            // console.log(hpju)
            if(app.data.tipe == 'S'){
                axios.get(
                    "{{ route('penawaran.harsat') }}" + "?kd_produk=" + app.data.kd_produk + "&pat=" + app.data.kd_pabrik
                ).then(response => {
                    panjang = parseInt(response.data.panjang)
                    kg = parseFloat(response.data.kg)
                    harsat = parseInt(response.data.nilai_hpp)
                    var h_trans = 0
                    if(app.data.harga_angkutan != ""){
                        h_trans = parseInt(app.data.harga_angkutan.toString().replace(/[^0-9\.]/g,''))
                        h_trans = h_trans + (h_trans * cad_trans);
                        h_trans = parseFloat(h_trans / kg).toFixed(0);
                    }
                    harsat = harsat + (harsat * cad_hpp);
                    if(app.data.sbu == 'B' || app.data.sbu == 'E'){
                        harsat = parseFloat(harsat / panjang).toFixed(0);
                    }
                    total = harsat + h_trans
                    total = parseFloat(total / hpju).toFixed(0)

                    if(app.data.sbu == 'A' || app.data.sbu == 'F' || app.data.sbu == 'F'){
                        var satuan_ = 'pcs'
                    }else{
                        var satuan_ = 'meter'
                    }
                    if(app.data.tipe == 'NS'){
                        satuan_ = app.data.satuan
                    }
                    let tmp = {
                        kd_produk : app.data.kd_produk,
                        sbu: app.data.sbu,
                        ket_sbu: app.data.ket_sbu,
                        kd_produk: app.data.kd_produk,
                        tipe_produk: tipe_produk,
                        // volume: app.data.volume + ' ' + satuan_,
                        volume: app.data.volume,
                        satuan: satuan_,
                        harsat: harsat, 
                        transport: h_trans,
                        ket_transport: 'Rp. ' + vm.thousandSeparator(h_trans),
                        ket_harsat: 'Rp. ' + vm.thousandSeparator(harsat),
                        total: total,
                        ket_total: 'Rp. ' + vm.thousandSeparator(total)
                    }

                    app.data.produk.push(tmp)
                })

            }else{
                harsat = parseInt(app.data.harsat_manual.toString().replace(/[^0-9\.]/g,''))
                var h_trans = 0
                if(app.data.harga_angkutan != ""){
                    h_trans = parseInt(app.data.harga_angkutan.toString().replace(/[^0-9\.]/g,''))
                    h_trans = h_trans + (h_trans * cad_trans);
                }
                harsat = harsat + (harsat * cad_hpp);
                total = harsat + h_trans
                total = parseFloat(total / hpju).toFixed(0)

                if(app.data.sbu == 'A' || app.data.sbu == 'F' || app.data.sbu == 'F'){
                    var satuan_ = 'pcs'
                }else{
                    var satuan_ = 'meter'
                }
                if(app.data.tipe == 'NS'){
                    satuan_ = app.data.satuan
                }
                let tmp = {
                    kd_produk : app.data.kd_produk,
                    sbu: app.data.sbu,
                    ket_sbu: app.data.ket_sbu,
                    kd_produk: app.data.kd_produk,
                    tipe_produk: tipe_produk,
                    // volume: app.data.volume + ' ' + satuan_,
                    volume: app.data.volume,
                    satuan: satuan_,
                    harsat: harsat,
                    transport: h_trans,
                    ket_transport: 'Rp. ' + vm.thousandSeparator(h_trans),
                    ket_harsat: 'Rp. ' + vm.thousandSeparator(harsat),
                    total: total,
                    ket_total: 'Rp. ' + vm.thousandSeparator(total)
                }

                app.data.produk.push(tmp)
            }

            app.btnAddProduct = 'Tambah Produk'
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
            "{{ route('penawaran.store-nego') }}", {
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
            vm.btnCalculateTotal = 'Menghitung...'

            var cad_hpp = 0;
            if(vm.data.idx_cad_hpp != ""){
                cad_hpp = parseInt(vm.data.idx_cad_hpp.toString().replace(/[^0-9\.]/g,'')) / 100;
            }
            var cad_trans = 0;
            if(vm.data.idx_cad_transportasi != ""){
                cad_trans = (parseInt(vm.data.idx_cad_transportasi.toString().replace(/[^0-9\.]/g,'')) / 100);
            }
            var hpju = 1;
            if(vm.data.idx_hpju != ""){
                hpju = 1 - (parseInt(vm.data.idx_hpju.toString().replace(/[^0-9\.]/g,'')) / 100);
            }

            if (vm.data.diskon > 0) {
                vm.data.produk = {!! json_encode($produk) !!}
            }
            for (produk of vm.data.produk) {
                // if (vm.data.diskon > 0) {
                //     var discount = vm.data.diskon / 100
                //     var tmp_harsat = 0
                //     var tmp_trans = 0
                //     var tmp_total = 0 //hrgjual
                       
                //     tmp_harsat = produk.harsat - (produk.harsat * discount)
                //     produk.harsat = parseFloat(tmp_harsat).toFixed(0)

                //     tmp_trans = produk.transport - (produk.transport * discount) 
                //     produk.transport = parseFloat(tmp_trans).toFixed(0)

                //     tmp_total = parseInt(produk.harsat) + parseInt(produk.transport)
                //     produk.total = parseFloat(tmp_total / hpju).toFixed(0)
                // }   

                // var vol_prod = produk.volume.toString().replace(/[^0-9\.]/g,'')
                // t_h_jual += parseFloat(produk.total) * vol_prod
                // t_hpp += parseFloat(produk.harsat/(1+cad_hpp)) * vol_prod
                // t_trans += parseFloat(produk.transport/(1+cad_trans)) * vol_prod
                // ttl += parseFloat(produk.total) * vol_prod
                var tmp_harsat = 0
                var tmp_trans = 0
                var tmp_total = 0
                if (vm.data.diskon > 0) {
                    var discount = vm.data.diskon / 100
                       
                    tmp_harsat = produk.harsat - (produk.harsat * discount)
                    produk.harsat = vm.thousandSeparator(parseFloat(tmp_harsat).toFixed(0))

                    tmp_trans = produk.transport - (produk.transport * discount) 
                    produk.transport = vm.thousandSeparator(parseFloat(tmp_trans).toFixed(0))

                    tmp_total = (tmp_harsat + tmp_trans) / hpju
                    produk.total = vm.thousandSeparator(parseFloat(tmp_total).toFixed(0))
                }else{
                    tmp_harsat = produk.harsat
                    tmp_trans = produk.transport
                    tmp_total = produk.total
                }   

                var vol_prod = produk.volume.toString().replace(/[^0-9\.]/g,'')
                t_h_jual += parseFloat(tmp_total) * vol_prod
                t_hpp += parseFloat((tmp_harsat/(1+cad_hpp)).toFixed(0)).toFixed(0) * vol_prod
                t_trans += parseFloat((tmp_trans/(1+cad_trans)).toFixed(0)).toFixed(0) * vol_prod
                ttl += parseFloat(tmp_total) * vol_prod
            }
            if(vm.data.biaya_pelaksanaan != ""){
                t_bup_bp = (parseInt(vm.data.biaya_pelaksanaan.replace(".", "")) * ttl / 100)
                ttl = ttl + t_bup_bp
            }
            t_lkb = ((t_h_jual - t_hpp - t_trans - t_bup_bp) / t_h_jual * 100).toFixed(2)
            vm.data.total_penawaran = vm.thousandSeparator(total)
            vm.data.ttl_h_jual = vm.thousandSeparator(t_h_jual)
            vm.data.ttl_hpp = vm.thousandSeparator(t_hpp)
            vm.data.ttl_trans = vm.thousandSeparator(t_trans)
            vm.data.ttl_bup_bp = vm.thousandSeparator(t_bup_bp)
            vm.data.ttl_lkb = t_lkb + "%"
            vm.btnCalculateTotal = 'Hitung Total'
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
