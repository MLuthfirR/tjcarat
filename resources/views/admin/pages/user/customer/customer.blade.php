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
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer Management & Approval</h3>
                <div class="d-flex align-items-center">
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
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <x-order-table  :id="Str::uuid()->toString()"
                        :actionUrl="route('webapi.sa.get')"
                        :headers="['Name', 'Company', 'Verified', 'Status']"
                        defaulttype="customer"
                        pic="sa-customer">
            <x-slot name="list">
                <x-order-table.tab-item type="customer" label="All Customers" badge-class="badge-light"/>
                <x-order-table.tab-item type="inactive" badge-class="badge-danger"/>
            </x-slot>
            <x-order-table.table-item type="customer" actionApi="fetchActiveUsers"/>
            <x-order-table.table-item type="inactive" actionApi="fetchInactiveUsers"/>
        </x-order-table>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @include('admin.pages.user.confirmation_modal.confirmation_modal')
    @include('components.modals.order_detail.order_detail_main')
@endsection

@push('scripts')
    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('.select2').select2({
            width: 'resolve'
        });
    </script>
@endpush
