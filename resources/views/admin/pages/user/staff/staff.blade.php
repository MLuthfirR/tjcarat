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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Staff Management</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('sa.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item"><a href="{{ route('sa.users.staff') }}">Staff Management</a></li>
                        </ol>
                    </nav>
                </div>
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
        <div class="row mb-4">
            <div class="col-12">
                @include('sa.pages.user.staff.add_staff.add_staff')
            </div>
        </div>
        <x-order-table  :id="Str::uuid()->toString()"
                        :actionUrl="route('webapi.sa.get')"
                        :headers="['Name', 'Type', 'Permissions', 'Verified', 'Status']"
                        defaulttype="staff"
                        pic="sa-staff">
            <x-slot name="list">
                <x-order-table.tab-item type="staff" label="All Staff" badge-class="badge-light"/>
                <x-order-table.tab-item type="inactive" badge-class="badge-danger"/>
            </x-slot>
            <x-order-table.table-item type="staff" actionApi="fetchStaff"/>
            <x-order-table.table-item type="inactive" actionApi="fetchInactiveStaff"/>
        </x-order-table>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @include('sa.pages.user.confirmation_modal.confirmation_modal')
@endsection

@push('scripts')
    <script src="{{ asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $('.select2').select2({
            width: 'resolve'
        });
    </script>
@endpush
