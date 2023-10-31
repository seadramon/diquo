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
                                <label class="form-label">SBU</label>
                                <select class="form-control" id="sbu" v-model="data.sbu">
                                    <option  v-for="(row,idx) in dropdown.sbu" :value="idx + '#'  + row">@{{ row }}</option>
                                </select>
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
                            <input type="text" name="volume" id="volume" v-model="data.volume" class="form-control volume currency">
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
                                    <th width="35%">SBU</th>
                                    <th width="20%">Tipe Produk</th>
                                    <th width="5%">Volume</th>
                                    <th width="5%">Satuan</th>
                                    <th width="10%">HPP</th>
                                    <th width="10%">Total</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row, idx) in data.produk">
                                    <td>&nbsp;@{{ row.kd_produk }}</td>
                                    <td>@{{ row.ket_sbu }}</td>
                                    <td>@{{ row.tipe_produk}}</td>
                                    <td>@{{ row.volume }}</td>
                                    <td>@{{ row.satuan }}</td>
                                    <td>@{{ row.ket_harsat }}</td>
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

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Pabrik</label>
                            <select class="form-control" id="pabrik-angkutan">
                                <option  v-for="(row,idx) in dropdown.pabrik" :value="idx + '#'  + row">@{{ row }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Jarak</label>
                            <input type="text" v-model="data.jarak" name="data.jarak" id="jarak" class="form-control jarak">
                        </div>

                        <div class="form-group mb-3 col-lg-7 ">
                            <label class="form-label">Harga Angkutan</label>
                            <input type="text" readonly v-model="data.harga_angkutan" name="harga_angkutan" id="harga_angkutan" class="form-control form-control-solid">
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
                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks Cadangan HPP</label>
                            <input type="number" v-model="data.idx_cad_hpp" name="idx_cad_hpp" id="idx_cad_hpp" class="form-control currency">
                        </div>

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks Cadangan Transportasi</label>
                            <input type="number" v-model="data.idx_cad_transportasi" name="idx_cad_transportasi" id="idx_cad_transportasi" class="form-control currency">
                        </div>

                        <div class="form-group mb-3 col-lg-12">
                            <label class="form-label">Indeks HPJu</label>
                            <input type="number" v-model="data.idx_hpju" name="idx_hpju" id="idx_hpju" class="form-control currency">
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
                            <input type="text" name="total" v-model="data.biaya_pelaksanaan" id="total" class="form-control total currency">
                        </div>

                        <div class="card-footer" style="text-align: right;">
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
            nama_pelanggan:"{{ $permintaan->nama_pelanggan ?? "" }}",
            nama_perusahaan:'',
            no_hp:'',
            email:'',
            nama_proyek:"{{ $permintaan->nama_proyek ?? "" }}",
            lokasi: '',
            kondisi: '',
            tipe: '',
            pic: '',
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
            produk: {!! json_encode($produk) !!}
        },
        dropdown: {
            lokasi : {!! json_encode($lokasi) !!},
            kondisi : {!! json_encode($kondisi) !!},
            pic : {!! json_encode($pic) !!},
            sbu : {!! json_encode($sbu) !!},
            tipe : {!! json_encode($tipe) !!},
            pabrik : {!! json_encode($pabrik) !!},
            jenis_angkutan: {!! json_encode($jnsAngkutan) !!},
            no_surat: {!! json_encode($no_surat) !!}
        },
        pricelist: {!! json_encode($pricelist) !!},
        btnAddProduct: 'Tambah Produk',
        btnLihatHarga: 'Lihat Harga',
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

        $(".currency").keyup(function() {
            var rp = formatRupiah(this.value);
            $(this).val(rp);
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
            let harsat = 0
            let total = 0
            app.btnAddProduct = 'Menambahkan...'

            let arrtipe = app.data.select_tipe_produk.split("#")
            app.data.kd_produk = arrtipe[0]
            app.data.tipe_produk = arrtipe[1]

            let tipe_produk = app.data.tipe_produk
            if(app.data.tipe == 'S'){
                axios.get(
                    "{{ route('penawaran.harsat') }}" + "?kd_produk=" + app.data.kd_produk + "&pat=" + app.data.pabrik
                ).then(response => {
                    harsat = response.data.nilai_hpp
                    total = harsat * app.data.volume
                })
            }else{
                harsat = app.data.harsat_manual
                total = harsat * app.data.volume
            }
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
                ket_harsat: 'Rp. ' + harsat,
                total: total,
                ket_total: 'Rp. ' + total
            }

            app.data.produk.push(tmp)

            app.btnAddProduct = 'Tambah Produk'
        },
        removeProduk(idx) {
            app.data.produk.splice(idx, 1)
        },
        showPrice() {
            app.btnLihatHarga = "Please wait..."
            axios.get(
                "{{ route('penawaran.harga') }}"
            ).then(response => {
                var res = response.data

                if (res.result == 'success') {
                    app.btnLihatHarga = "Lihat Harga"
                    app.data.harga_angkutan = res.harga
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
        }
    }
})
</script>
@endsection