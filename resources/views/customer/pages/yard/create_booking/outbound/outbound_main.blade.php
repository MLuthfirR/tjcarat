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
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Outbound</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.index') }}">Yard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('yard.booking.create.outbound.main') }}">Outbound</a></li>
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
        @include('components.alert')
        <div class="row px-0 mb-3 px-lg-3 font-14">
            <div class="col-12 mb-4">
                @include('customer.pages.yard.create_booking.outbound.outbound_steps.outbound_steps')
            </div>
        </div>
        <div class="row px-0 mb-3 px-lg-3 font-14">
            <div class="col-12">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                        @include('customer.pages.yard.create_booking.outbound.outbound_fetch.outbound_fetch')
                    </div>
                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                        @include('customer.pages.yard.create_booking.outbound.outbound_select.outbound_select')
                    </div>
                    <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                        @include('customer.pages.yard.create_booking.outbound.outbound_finalize.outbound_finalize')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script>
        var apiUrl = "{{ route('webapi.customer.post') }}";

        function resetAll() {
            resetSteps();
            resetAllSelectElmt();
            resetFinalInput();
            disableSelectBtn();
            disableFinalBtn();
            emptyPriceDetail();

            $('.bl-section').addClass('d-none');
            $('.container-section').addClass('d-none');
        }

        function resetButton() {
            resetAll();
            $("#step1-tab").tab('show');
            $('#form_container').find('input[type=input], input[type=date]').val("");
            $('#form_container').parsley().reset();
            $('#form_bl').find('input[type=input], input[type=date]').val("");
            $('#form_bl').parsley().reset();
        }

        $(document).ready(function() {
            resetAll();
        });

</script>

@endpush
