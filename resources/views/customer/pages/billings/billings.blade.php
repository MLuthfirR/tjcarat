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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">My Billings</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">My Billings</a></li>
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
        <div class="row">
            <p class="text-right mb-1 mx-3 w-100 font-14">Last updated: <span id="last-updated-date">-</span> <a href="javascript:" onclick="refreshBillings()"><i class="fas fa-sync-alt" id="refresh-button"></i></a></p>
            <div class="col-12 collapse" id="spinner-collapse">
                <div class="text-center bg-white my-2 py-2">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="text-muted mb-0">Fetching data...</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0 w-100" id="billings-table">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0">
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Invoice No.
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Created Date
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Status</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">
                                            Total
                                        </th>
                                        <th class="border-0">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
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

@include('customer.pages.billings.js_billings')
