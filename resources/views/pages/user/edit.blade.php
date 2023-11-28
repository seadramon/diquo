@extends('layout.layout2')

@section('page-title')
<!--begin::Page title-->
<div class="page-title d-flex justify-content-center flex-column me-5">
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">User Login</h1>
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
            {!! Form::open(['url' => route('user.store'), 'class' => 'form', 'method' => 'post']) !!}

                <div class="card shadow-sm mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Update User Login</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" v-model="data.name" disabled>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" v-model="data.password" id="password" class="form-control">
                            <span class="msg-error">@{{ err.password }}</span>
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" v-model="data.confirm_password" id="confirm_password" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-lg-6">
                            <label class="form-label">List Menu</label>

                            <div class="form-check form-check-custom form-check-solid mb-2">
                                <input class="form-check-input" v-model="data.listmenu" value="permintaan-penawaran" type="checkbox" id="permintaan-penawaran"/>
                                <label class="form-check-label" for="permintaan-penawaran">
                                    Permintaan Penawaran
                                </label>
                            </div>

                            <div class="form-check form-check-custom form-check-solid mb-2">
                                <input class="form-check-input" v-model="data.listmenu" value="penawaran" type="checkbox" id="penawaran"/>
                                <label class="form-check-label" for="penawaran">
                                    Penawaran
                                </label>
                            </div>
                        </div>

                        <div class="card-footer" style="text-align: right;">
                            <a href="{{ route('user.index') }}" class="btn btn-light btn-active-light-primary me-2">Kembali</a>

                            <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary" @click.prevent="onSubmit()" id="btnSubmit">
                                <span class="indicator-label">Update</span>
                                <span class="indicator-progress">Updating... 
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
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
            name:"{{ $data->name }}",
            employee_id:"{{ $data->employee_id }}",
            password: '',
            confirm_password: '',
            listmenu: {!! json_encode($listmenu) !!}
        },
        err: {
            password: '',
        },
        isLoading: false,
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
    },
    methods: {
        initSelect2: function (e) {
            
        },
        checkForm() {
            let vm = this
            let countErr = 0

            console.log()

            if (vm.data.password != "") {
                if (vm.data.password != vm.data.confirm_password) {
                    vm.err.password = "The password confirmation doesnt match"
                    countErr = countErr + 1
                }
            }

            if (countErr > 0) {
                return false
            }

            return true
        },
        onSubmit() {
            let vm = this
                        
            if (this.checkForm()) {
                this.setBtnSubmit(true)

                axios.put(
                "{{ route('user.update', ['user' => $id]) }}", app.data)
                .then(resp => {
                    let response = resp.data

                    if (response.result == "success") {
                        flasher.success("Data has been saved successfully!")

                        setTimeout(() => {
                            window.location.href = "{{ route('user.index')}}"
                        }, 3000)
                    } else {
                        flasher.error("Error! Something went wrong!")
                    }

                    vm.setBtnSubmit(false)
                })
                .catch(err => {
                    vm.setBtnSubmit(false)

                    flasher.error(err.response.data.message)
                })
            }
        },
        setBtnSubmit(swich){
            if (swich) {
                $("#btnSubmit").attr("data-kt-indicator", "on")
                $("#btnSubmit").prop("disabled", true)
            } else {
                $("#btnSubmit").removeAttr("data-kt-indicator")
                $("#btnSubmit").prop("disabled", false)
            }
        },
        reset() {
            Object.assign(this.$data, initialState());
        }
    }
})
</script>
@endsection
