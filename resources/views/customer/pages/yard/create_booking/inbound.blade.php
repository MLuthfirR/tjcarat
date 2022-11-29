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
                            <li class="breadcrumb-item"><a href="{{ route('yard.index') }}">Yard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.booking.create.inbound') }}">Issue Booking Ticket (Inbound)</a></li>
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
                    <div class="card my-4 px-0 px-lg-3">
                        <div class="card-body">
                            <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                <div class="row m-0">
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h5 class="mb-sm-0 text-white">1. Booking Header</h5>
                                    </div>
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h6 class="mb-0 text-white text-capitalize float-sm-right"><i class="fas fa-map"></i> Yard</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-0 px-lg-3">
                                <div class="col-md-7">
                                    <div class="card my-4 shadow">
                                        <div class="card-body">
                                            <div class="bg-success p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                                <div class="row m-0">
                                                    <div class="col-12 m-0 p-0 align-self-center">
                                                        <h5 class="mb-0 text-white text-center">Booking Information</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                                @foreach ($origin_destination_fields as $field)
                                                    @include('layouts.input_form')
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card my-4 shadow">
                                        <div class="card-body">
                                            <div class="bg-success p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                                <div class="row m-0">
                                                    <div class="col-12 m-0 p-0 align-self-center">
                                                        <h5 class="mb-0 text-white text-center">Booking Date</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                                @foreach ($booking_estimation_fields as $field)
                                                    @include('layouts.input_form')
                                                @endforeach
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
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h5 class="mb-sm-0 text-white">2. Containers</h5>
                                    </div>
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h6 class="mb-0 text-white float-sm-right"><i class="fas fa-boxes"></i></h6>
                                    </div>
                                </div>
                            </div>
                            @include('customer.components.create_ticket_components.containers_create.containers_create', [
                                'required' => true,
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 px-lg-3">
                    <div class="card my-4 px-0 px-lg-3">
                        <div class="card-body">
                            <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                <div class="row m-0">
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h5 class="mb-sm-0 text-white">3. Documents</h5>
                                    </div>
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h6 class="mb-0 text-white float-sm-right"><i class="fas fa-file-alt"></i></h6>
                                    </div>
                                </div>
                            </div>
                            @include('customer.components.create_ticket_components.documents_create.documents_create')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-3 mt-5">
                <div class="col-2"></div>
                <div class="col-8 my-2">
                    <button type="button" id="submit-form" class="btn btn-outline-primary btn-block" onclick="storeOrder()">
                        Request Booking Ticket
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
    @include('components.modals.document_uploader.document_uploader_modal')
    @include('components.modals.success.success_modal')
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

@include('customer.pages.yard.create_booking.js_inbound')
