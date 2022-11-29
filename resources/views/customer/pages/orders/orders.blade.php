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
            <div class="col-xs-12 col-md-8 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">My Orders</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders') }}">My Orders</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-xs-12 col-md-4 align-self-center">
                @include('customer.components.create_order_selection.create_order_select')
            </div>
            <div class="col-12 mt-3">
                <x-warning-message />
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
        <x-order-table :id="Str::uuid()->toString()" :actionUrl="route('webapi.customer.get')" pic="customer">
            <x-slot name="list">
                <x-order-table.tab-item type="outstanding" badge-class="badge-warning"/>
                <x-order-table.tab-item type="active" badge-class="badge-light"/>
                <x-order-table.tab-item type="completed" badge-class="badge-success"/>
                <x-order-table.tab-item type="cancelled" badge-class="badge-danger"/>
            </x-slot>
            <x-order-table.table-item type="outstanding" actionApi="fetchOutstandingOrdersUser"/>
            <x-order-table.table-item type="active" actionApi="fetchActiveOrdersUser"/>
            <x-order-table.table-item type="completed" actionApi="fetchCompletedOrdersUser"/>
            <x-order-table.table-item type="cancelled" actionApi="fetchCancelledOrdersUser"/>
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

            if (should_update_modal) {
                implementGatePassToggles(toggles);
            }
        }

        function implementStatusUpdate(order_uuid, status, should_update_modal=true) {
            baseImplementStatusUpdate("customer", order_uuid, status, should_update_modal);
        }
    </script>
@endpush
