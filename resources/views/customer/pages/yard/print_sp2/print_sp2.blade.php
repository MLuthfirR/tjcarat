@extends('main')

@section('css')
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-xs-12 col-md-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Print SP2</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.index') }}">Yard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.sp2.print') }}">Print SP2</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xs-12 col-md-5 align-self-center">
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <form id="form_createorder" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row">
                <div class="col-12 px-0 px-lg-3">
                    <p class="font-14 text-dark mb-1">Don't have SP2 yet? Issue yard outbound order below:</p>
                    <div class="shadow-sm mb-4 special-btn" style="border: 1px dashed #ddd;border-radius: 8px" id="add-new-staff-container">
                        <a href="{{ route('yard.booking.create.outbound.main') }}">
                            <div class="row px-4 py-3 align-items-center">
                                <div class="col-12">
                                    <h5 class="mb-0 font-weight-medium" id="quotation-title">+ Yard Outbound Order</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-12 px-0 px-lg-3">
                    <div class="card my-4 px-0 px-lg-3">
                        <div class="card-body">
                            <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                <div class="row m-0">
                                    <div class="col-12 m-0 p-0 align-self-center">
                                        <h5 class="mb-sm-0 text-white">Container Data</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-0 px-lg-3">
                                <div class="col-md-5">
                                    <div class="row px-3">
                                        <div class="col-12 mb-3">
                                            <div class="p-3 shadow-sm" style="border: 1px dashed #6c757d; border-radius: 8px">
                                                <a href="#add-container-collapse" class="" data-toggle="collapse" aria-controls="add-container-collapse">
                                                    <div class="row align-items-center">
                                                        <div class="col-10">
                                                            <h5 class="font-14 font-weight-medium text-dark mb-0">Input Container</h5>
                                                        </div>
                                                        <div class="col-2 collapse-arrow">
                                                            <i class="icon text-secondary" data-feather="chevron-down"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="collapse show" id="add-container-collapse">
                                                    <div class="row pt-3">
                                                        @foreach ($input_container_fields as $field)
                                                            @include('layouts.input_form')
                                                        @endforeach
                                                        <div class="col-12 d-flex mb-2 justify-content-center">
                                                            <button type="button" class="btn btn-primary">Fetch Container Data</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card my-4 shadow">
                                        <div class="card-body">
                                            <div class="bg-success p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                                <div class="row m-0">
                                                    <div class="col-12 m-0 p-0 align-self-center">
                                                        <h5 class="mb-0 text-white text-center">Container</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 px-lg-3">
                    <div class="card my-4 px-0 px-lg-3">
                        <div class="card-body">
                            <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                <div class="row m-0">
                                    <div class="col-12 m-0 p-0 align-self-center">
                                        <h5 class="mb-sm-0 text-white">SP2 Information</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-0 px-lg-3">
                                @foreach ($input_sp2_fields as $field)
                                    @include('layouts.input_form')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3 mt-5">
                <div class="col-2"></div>
                <div class="col-8 my-2">
                    <button type="button" id="submit-form" class="btn btn-outline-primary btn-block" onclick="storeOrder()">
                        Print SP2
                    </button>
                </div>
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-8">
                    <button type="reset" class="btn btn-outline-danger btn-block border-0 align-self-center">
                        Reset
                    </button>
                </div>
                <div class="col-2 my-2"></div>
            </div>
        </form>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

@include('customer.pages.yard.create_booking.js_outbound')
