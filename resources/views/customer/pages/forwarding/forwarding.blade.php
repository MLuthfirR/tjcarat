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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Forwarding</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('forwarding.index') }}">Forwarding</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 align-self-center">
                <div class="btn-group float-md-right" role="group" aria-label="Create Order">
                    <a href="javascript:" data-toggle="collapse" data-target="#order-forwarding-collapse" role="button" class="btn waves-effect waves-light border-rounded btn-outline-primary my-2 mr-2">
                        + Forwarding Order Ticket
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
    <div class="collapse row mt-3" id="order-forwarding-collapse">
        <div class="col-12">
            <div class="card rounded-0" style="box-shadow: 0px -9px 8px -15px inset #333, 0px 9px 8px -15px inset #333;">
                <div class="card-body">
                    <h4 class="card-title">Choose Order Type:</h4>
                    <div class="row mx-5 mt-5 mb-0">
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="{{ route('forwarding.order.createexport') }}">
                                <div class="card card-container card-container-sm">
                                    <img class="card-img-top card-img-top-sm" src="{{asset('assets/img/export.jpg')}}">
                                    <div class="card-img-overlay text-white">
                                        <div class="row h-100">
                                            <div class="col-12 align-self-center">
                                                <h4 class="card-title text-center text-white mb-0">+ Export</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="{{ route('forwarding.order.createimport') }}">
                                <div class="card card-container card-container-sm">
                                    <img class="card-img-top card-img-top-sm" src="{{asset('assets/img/import.jpg')}}">
                                    <div class="card-img-overlay text-white">
                                        <div class="row h-100">
                                            <div class="col-12 align-self-center">
                                                <h4 class="card-title text-center text-white mb-0">+ Import</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 offset-sm-3 offset-md-0 col-md-4">
                            <a href="{{ route('forwarding.order.createdomestic') }}">
                                <div class="card card-container card-container-sm">
                                    <img class="card-img-top card-img-top-sm" src="{{asset('assets/img/domestic.jpg')}}">
                                    <div class="card-img-overlay text-white">
                                        <div class="row h-100">
                                            <div class="col-12 align-self-center">
                                                <h4 class="card-title text-center text-white mb-0">+ Domestic</h4>
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
            <x-order-table.table-item type="outstanding" destlabel="Origin - Destination" actionApi="fetchOutstandingForwardingOrdersUser"/>
            <x-order-table.table-item type="active" destlabel="Origin - Destination" actionApi="fetchActiveForwardingOrdersUser"/>
            <x-order-table.table-item type="completed" destlabel="Origin - Destination" actionApi="fetchCompletedForwardingOrdersUser"/>
            <x-order-table.table-item type="cancelled" destlabel="Origin - Destination" actionApi="fetchCancelledForwardingOrdersUser"/>
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
        function updateStatus(elmt, action) {
            var actionUrl = "{{ route('webapi.customer.post') }}"
            var actionApi = {
                'approve' : "updateStatusOrderApproved",
            }
            baseUpdateStatus(elmt, action, actionUrl, actionApi);
        }

        function implementToggles(toggles, should_update_modal=true) {
            baseImplementToggles(toggles, should_update_modal);
        }

        function implementStatusUpdate(order_uuid, status, should_update_modal=true) {
            baseImplementStatusUpdate("customer", order_uuid, status, should_update_modal);
        }
    </script>
@endpush
