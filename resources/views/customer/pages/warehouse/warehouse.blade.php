@extends('pages.warehouse.warehouse')

@section('warehouse-header')
    <div class="col-xs-12 col-md-4 align-self-center">
        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Warehouse</h3>
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('warehouse.index') }}">Warehouse</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="col-xs-12 col-md-8 align-self-center">
        <div class="btn-group float-xs-middle float-md-right" role="group" aria-label="Create Booking">
            <a href="javascript:" data-toggle="collapse" data-target="#booking-warehouse-collapse" role="button" class="btn waves-effect waves-light border-rounded btn-outline-primary my-2 mr-2">
                + Booking Ticket
            </a>
        </div>
    </div>
@endsection

@section('warehouse-pre-components')
    <div class="collapse row mt-3" id="booking-warehouse-collapse">
        <div class="col-12">
            <div class="card rounded-0" style="box-shadow: 0px -9px 8px -15px inset #333, 0px 9px 8px -15px inset #333;">
                <div class="card-body">
                    <h4 class="card-title">Choose Booking Type:</h4>
                    <div class="row mx-5 mt-5 mb-0">
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('warehouse.booking.create.inbound.index') }}">
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
                            <a href="{{ route('warehouse.booking.create.outbound') }}">
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
@endsection
