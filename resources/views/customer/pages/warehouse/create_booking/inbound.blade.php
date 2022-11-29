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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Issue Booking Ticket (Inbound)</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('warehouse.index') }}">Warehouse</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('warehouse.booking.create.inbound.index') }}">Issue Booking Ticket (Inbound)</a></li>
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
        <div class="row">
            <div class="col-12 px-0 px-lg-3">
                <div class="card my-4 px-0 px-lg-3">
                    <div class="card-body">
                        <div class="bg-secondary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                            <div class="row m-0">
                                <div class="col-12 m-0 p-0 align-self-center">
                                    <h5 class="mb-sm-0 text-white">Choose Job/Movement Type<span class="text-danger">*</span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{ route('warehouse.booking.create.inbound.domestic') }}" class="btn btn-outline-primary btn-block" style="border-radius: 8px;">
                                    <div class="d-flex align-items-center justify-content-center p-5">
                                        <p class="mb-0 ml-2 font-weight-medium">DOMESTIC</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('warehouse.booking.create.inbound.export') }}" class="btn btn-outline-primary btn-block" style="border-radius: 8px;">
                                    <div class="d-flex align-items-center justify-content-center p-5">
                                        <p class="mb-0 ml-2 font-weight-medium">EXPORT</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
