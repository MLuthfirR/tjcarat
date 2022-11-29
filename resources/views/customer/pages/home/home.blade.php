@extends('main')

@section('css')
    <link href="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid d-flex flex-column align-items-center justify-content-center" style="min-height: calc(110vh - 210px);">
        <div class="row mb-2">
            <div class="col-12">
                <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" style="width: 60px"/>
            </div>
        </div>
        <div class="row">
            <div class="col-12 w-75">
                <h2 class="page-title text-truncate text-dark text-center font-weight-medium mb-1" id="greetings-title" style="word-wrap: break-word;
                white-space: normal;"></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 py-2 align-self-center">
                <a href="{{ route('orders') }}"  type="button"
                    class="btn btn-block waves-effect waves-light btn-rounded btn-outline-secondary font-14" style="min-width: 200px">
                        <span class="mb-0">
                            <i data-feather="tag" class="feather-icon"></i> My Orders
                            <span class="badge {{ (isset($data->outstanding_orders) && $data->outstanding_orders > 0) ? 'badge-warning' : 'badge-light' }}" id="tabs-outstanding-orders-badge" style="border-radius: 4px">{{ isset($data->outstanding_orders) ? $data->outstanding_orders : '-' }}</span>
                        </span>
                </a>
            </div>
            <div class="col-md-6 py-2 align-self-center">
                <a href="{{ route('billing.index') }}" type="button"
                    class="btn btn-block waves-effect waves-light btn-rounded btn-outline-secondary font-14" style="min-width: 200px">
                        <span class="mb-0">
                            <i data-feather="credit-card" class="feather-icon"></i> My Billings
                            <span class="badge {{ (isset($data->outstanding_billings) && $data->outstanding_billings > 0) ? 'badge-warning' : 'badge-light' }}" id="tabs-outstanding-billings-badge" style="border-radius: 4px">{{ isset($data->outstanding_billings) ? $data->outstanding_billings : '-' }}</span>
                        </span>
                </a>
            </div>
        </div>
        @include('customer.components.create_order_selection.create_order_select')
    </div>
    @include('customer.components.create_order_selection.create_order_modal')
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#greetings-title').html('Good ' + getGreetingTime(moment()) + ', {{ $user->name }}');
        });
    </script>
@endpush
