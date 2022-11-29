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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Issue Booking Ticket (Outbound)</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('warehouse.index') }}">Warehouse</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('warehouse.booking.create.outbound') }}">Issue Booking Ticket (Outbound)</a></li>
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
                                        <h5 class="mb-sm-0 text-white">1. Outbound Booking</h5>
                                    </div>
                                    <div class="col-sm-6 m-0 p-0 align-self-center">
                                        <h6 class="mb-0 text-white text-capitalize float-sm-right"><i class="fas fa-warehouse"></i> Warehouse</h6>
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
                                                        <h5 class="mb-0 text-white text-center">Commodities</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                                <div class="col-12 mb-3">
                                                    <div class="p-3 shadow-sm" style="border: 1px dashed #6c757d; border-radius: 8px">
                                                        <a href="#add-house-bl-collapse" class="" data-toggle="collapse" aria-controls="add-house-bl-collapse">
                                                            <div class="row align-items-center">
                                                                <div class="col-10">
                                                                    <h5 class="font-14 font-weight-medium text-dark mb-0">Add Commodity</h5>
                                                                </div>
                                                                <div class="col-2 collapse-arrow">
                                                                    <i class="icon text-secondary" data-feather="chevron-down"></i>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="collapse show" id="add-house-bl-collapse">
                                                            <div class="row pt-3">
                                                                @foreach ($outbound_commodities_fields as $field)
                                                                    @include('layouts.input_form')
                                                                @endforeach
                                                                <div class="col-md-6">
                                                                    <p class="font-14 text-dark mb-0">Inbound Qty: <span class="font-weight-medium">20</span></p>
                                                                    <p class="font-12 text-muted">Quantity of commodity declared on inbound process. Please input outbound qty with max equal to inbound qty.</p>
                                                                </div>
                                                                <div class="col-12 d-flex mb-2 justify-content-center">
                                                                    <button type="button" class="btn btn-primary">+ Add To Outbound List</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h6 class="text-dark mb-2">Outbound Commodities<span class='text-danger'>*</span></h6>
                                                    <div class="shadow" style="max-height: 500px; overflow: auto; border-radius: 8px">
                                                        <div class="table-responsive" id="outbound-commodities-table-container">
                                                            <table class="table table-required no-wrap v-middle mb-0">
                                                                <thead>
                                                                    <tr class="border-0">
                                                                        <th class="border-0"></th>
                                                                        <th class="border-0"></th>
                                                                        <th class="border-0 font-14 font-weight-medium text-muted">Commodity
                                                                        </th>
                                                                        <th class="border-0 font-14 font-weight-medium text-muted">Qty
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="border-0">
                                                                            <input type="checkbox" name="outbound_commodities[]" value="Electronics LG"
                                                                                    data-parsley-required="true"
                                                                                    data-parsley-mincheck="1"
                                                                                    data-parsley-errors-container="#outbound-commodities-table-container"
                                                                                    data-parsley-error-message="At least one container must be selected" checked>
                                                                        </td>
                                                                        <td class="border-0" class="text-muted"><i data-feather="package"></i></td>
                                                                        <td class="border-0">
                                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Electronics LG</h5>
                                                                            <h5 class="text-dark mb-0 font-14 font-weight-medium">House BL : 01234567890</h5>
                                                                            <p class="text-muted font-14 m-0">Booking No. : BKWH0001</p>
                                                                        </td>
                                                                        <td class="border-0">
                                                                            <h5 class="font-14 font-weight-medium text-muted mb-0">20</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="outbound_commodities[]" value="Electronics Samsung"
                                                                                    data-parsley-required="true"
                                                                                    data-parsley-mincheck="1"
                                                                                    data-parsley-errors-container="#outbound-commodities-table-container"
                                                                                    data-parsley-error-message="At least one container must be selected" checked>
                                                                        </td>
                                                                        <td class="text-muted"><i data-feather="package"></i></td>
                                                                        <td>
                                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Electronics Samsung</h5>
                                                                            <h5 class="text-dark mb-0 font-14 font-weight-medium">House BL : 01234567891</h5>
                                                                            <p class="text-muted font-14 m-0">Booking No. : BKWH0002</p>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-14 font-weight-medium text-muted mb-0">20</h5>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="outbound_commodities[]" value="Electronics Apple"
                                                                                    data-parsley-required="true"
                                                                                    data-parsley-mincheck="1"
                                                                                    data-parsley-errors-container="#outbound-commodities-table-container"
                                                                                    data-parsley-error-message="At least one container must be selected" checked>
                                                                        </td>
                                                                        <td class="text-muted"><i data-feather="package"></i></td>
                                                                        <td>
                                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Electronics Apple</h5>
                                                                            <h5 class="text-dark mb-0 font-14 font-weight-medium">House BL : 01234567892</h5>
                                                                            <p class="text-muted font-14 m-0">Booking No. : BKWH0003</p>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-14 font-weight-medium text-muted mb-0">20</h5>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                        <h5 class="mb-0 text-white text-center">Outbound Information</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row px-3">
                                                @foreach ($outbound_information_fields as $field)
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
                                        <h5 class="mb-sm-0 text-white">2. Documents</h5>
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
                        Request Booking Order Ticket
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

@include('customer.pages.warehouse.create_booking.js_outbound')
