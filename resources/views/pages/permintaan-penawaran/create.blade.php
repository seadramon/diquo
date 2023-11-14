@extends('layout.layout2')

@section('page-title')
<!--begin::Page title-->
<div class="page-title d-flex justify-content-center flex-column me-5">
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Permintaan Penawaran</h1>
</div>
<!--end::Page title-->
@endsection

@section('content')
<!--begin::Content container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Row-->
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-12 mb-md-5 mb-xl-10">
            @if (isset($data))
                {!! Form::model($data, ['route' => ['permintaan-penawaran.update', $data->id], 'class' => 'form', 'id' => "form-driver", 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
            @else
                {!! Form::open(['url' => route('permintaan-penawaran.store'), 'class' => 'form', 'method' => 'post', 'id' => "form-driver", 'enctype' => 'multipart/form-data']) !!}
            @endif

            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Tambah Permintaan Penawaran</h3>
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
                        <div class="fv-row form-group col-lg-6 mb-3">
                            <label class="form-label required">Nama Proyek</label>
                            {!! Form::text('nama_proyek', null, ['class'=>'form-control', 'id'=>'nama_proyek', 'autocomplete'=>'off', 'required']) !!}
                        </div>

                        <div class="fv-row form-group col-lg-6 mb-3">
                            <label class="form-label required">Nama Perusahaan</label>
                            {!! Form::text('nama_pelanggan', null, ['class'=>'form-control', 'id'=>'nama_pelanggan', 'autocomplete'=>'off', 'required']) !!}
                        </div>

                        <div class="form-group col-lg-6 mb-3">
                            <label class="form-label required">Request Date</label>
                            <div class="col-lg-12">
                                <div class="input-group date">
                                    {!! Form::text('request_date', null, ['class'=>'form-control datepicker', 'id'=>'request_date', 'required']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="display: block">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-6 mb-3">
                            <label class="form-label required">Due Date</label>
                            <div class="col-lg-12">
                                <div class="input-group date">
                                    {!! Form::text('due_date', null, ['class'=>'form-control datepicker', 'id'=>'due_date', 'required']) !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="display: block">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fv-row form-group col-lg-6">
                            <label class="form-label required">SE</label>
                            {!! Form::select('pic', $se, null, ['class'=>'form-control form-select-solid col-sm-3', 'data-control'=>'select2', 'id'=>'pic', 'required']) !!}
                        
                        </div>
                        
                    </div>
                </div>
            
                <div class="card-footer" style="text-align: right;">
                    <a href="{{ route('permintaan-penawaran.index') }}" class="btn btn-light btn-active-light-primary me-2">Kembali</a>
                    <input type="submit" class="btn btn-success" id="btn-submit" value="Simpan">
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Content container-->
@endsection

@section('css')
<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('js')
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        autoApply: true,
        locale: {
            format: 'DD-MM-YYYY'
        }
    });
});

</script>
@endsection