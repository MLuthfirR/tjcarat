<div class="modal fade" id="create-order-modal" tabindex="-1" role="dialog" aria-labelledby="createordermodallabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-dark font-18 font-weight-medium" id="createordermodallabel">Choose Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row m-3 mb-0">
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#order-forwarding-collapse" data-toggle="collapse">
                            <div class="card card-container">
                                <img class="card-img-top" src="{{asset('assets/img/forwarding.jpg')}}">
                                <div class="card-img-overlay text-white">
                                    <h4 class="card-title text-white"><i data-feather="navigation" class="feather-icon mr-2"></i> Forwarding</h4>
                                    <p class="card-text"><small class="text-white">Goods distribution and consolidation services for export, import, and domestic through land, sea, and air.</small></p>
                                    <p class="card-text"><small class="text-white">+ Export, Import, Domestic</small></p>
                                </div>
                            </div>
                        </a>
                        <div class="collapse" id="order-forwarding-collapse">
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
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="#order-warehouse-collapse" data-toggle="collapse">
                            <div class="card card-container">
                                <img class="card-img-top" src="{{asset('assets/img/warehouse.jpg')}}">
                                <div class="card-img-overlay text-white">
                                    <h4 class="card-title text-white"><i data-feather="box" class="feather-icon mr-2"></i> Warehouse</h4>
                                    <p class="card-text"><small class="text-white">Book and manage storage on registered warehouses for your items.</small></p>
                                    <p class="card-text"><small class="text-white">+ Inbound, Outbound</small></p>
                                </div>
                            </div>
                        </a>
                        <div class="collapse" id="order-warehouse-collapse">
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
                    <div class="col-12 col-md-6 offset-md-3 offset-lg-0 col-lg-4">
                        <a href="#order-yard-collapse" data-toggle="collapse">
                            <div class="card card-container">
                                <img class="card-img-top" src="{{asset('assets/img/yard.jpg')}}">
                                <div class="card-img-overlay text-white">
                                    <h4 class="card-title text-white"><i data-feather="map" class="feather-icon mr-2"></i> Yard</h4>
                                    <p class="card-text"><small class="text-white">Book yard container storage and manage stored containers on registered yards.</small></p>
                                    <p class="card-text"><small class="text-white">+ Inbound, Outbound</small></p>
                                </div>
                            </div>
                        </a>
                        <div class="collapse" id="order-yard-collapse">
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
</div>
