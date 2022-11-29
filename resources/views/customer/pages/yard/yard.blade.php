@extends('main')

@section('css')
    <link href="{{ asset('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-xs-12 col-md-4 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Yard</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.index') }}">Yard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 align-self-center">
                <div class="btn-group float-xs-middle float-md-right" role="group" aria-label="Create Booking">
                    <a href="javascript:" data-toggle="collapse" data-target="#booking-yard-collapse" role="button" class="btn waves-effect waves-light border-rounded btn-outline-primary my-2 mr-2">
                        + Booking Ticket
                    </a>
                </div>
            </div>
            <div class="col-12 mt-3">
                <x-warning-message />
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="collapse row mt-3" id="booking-yard-collapse">
        <div class="col-12">
            <div class="card rounded-0" style="box-shadow: 0px -9px 8px -15px inset #333, 0px 9px 8px -15px inset #333;">
                <div class="card-body">
                    <h4 class="card-title">Choose Booking Type:</h4>
                    <div class="row mx-5 mt-5 mb-0">
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('yard.booking.create.inbound') }}">
                                <div class="card card-container card-container-sm">
                                    <img class="card-img-top card-img-top-sm" src="{{asset('assets/img/import.jpg')}}">
                                    <div class="card-img-overlay text-white">
                                        <div class="row h-100">
                                            <div class="col-12 align-self-center">
                                                <h4 class="card-title text-center text-white mb-0">+ Inbound</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('yard.booking.create.outbound.main') }}">
                                <div class="card card-container card-container-sm">
                                    <img class="card-img-top card-img-top-sm" src="{{asset('assets/img/export.jpg')}}">
                                    <div class="card-img-overlay text-white">
                                        <div class="row h-100">
                                            <div class="col-12 align-self-center">
                                                <h4 class="card-title text-center text-white mb-0">+ Outbound</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <x-order-table :id="Str::uuid()->toString()" :actionUrl="route('webapi.customer.get')" pic="customer">
            <x-slot name="list">
                <x-order-table.tab-item type="outstanding" badge-class="badge-warning"/>
                <x-order-table.tab-item type="active" badge-class="badge-light"/>
                <x-order-table.tab-item type="completed" badge-class="badge-success"/>
                <x-order-table.tab-item type="cancelled" badge-class="badge-danger"/>
            </x-slot>
            <x-order-table.table-item type="outstanding" actionApi="fetchOutstandingYardOrderUsers"/>
            <x-order-table.table-item type="active" actionApi="fetchActiveYardOrderUsers"/>
            <x-order-table.table-item type="completed" actionApi="fetchCompletedYardOrderUsers"/>
            <x-order-table.table-item type="cancelled" actionApi="fetchCancelledYardOrderUsers"/>
        </x-order-table>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @include('components.modals.order_detail.order_detail_main')
    @include('customer.components.create_order_selection.create_order_modal')
@endsection

@push('scripts')
    <script>
        function implementToggles(toggles, should_update_modal=true) {
            baseImplementToggles(toggles, should_update_modal);

            if (should_update_modal) {
                implementGatePassToggles(toggles);
            }
        }

        function implementStatusUpdate(order_uuid, status, should_update_modal=true) {
            baseImplementStatusUpdate("customer", order_uuid, status, should_update_modal);
        }
    </script>
@endpush
