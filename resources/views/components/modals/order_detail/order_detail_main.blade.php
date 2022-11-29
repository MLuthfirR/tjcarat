<div class="modal fade" id="order-detail-modal-main" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="modal-title w-100">
                    <div class="row">
                        <div class="col-10 col-sm-11">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="modal-title-text modal-ticket-number text-left">Order Detail</h5>
                                </div>
                                <div class="col-6">
                                    <p class="text-right mb-1 mx-3 w-100 font-14">Last updated: <span id="last-updated-detail-date">-</span> <a href="javascript:" onclick="refreshOrderDetail(this)"><i class="fas fa-sync-alt" id="refresh-detail-button"></i></a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 col-sm-1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body px-0">
                <input type="hidden" id="modal-customer-id">
                <div class="row mb-4 mx-4 mx-lg-5 px-3 bg-primary shadow shadow-sm" style="border-radius: 8px" id="order-detail-collapse-container">
                    <div class="col-12 px-4 py-3 align-self-center">
                        <a href="#order-detail-collapse" class="collapsed"data-toggle="collapse" aria-controls="order-detail-collapse">
                            <div class="row align-items-center modal-element">
                                <div class="col-12 mb-2">
                                    <h5 class="mb-0 text-white text-center font-weight-medium modal-ticket-number">-</h5>
                                </div>
                                <div class="col-12 collapse-arrow text-white text-center">
                                    Detail <i class="icon" data-feather="chevron-down"></i>
                                </div>
                            </div>
                            <div class="text-center modal-spinner">
                                <div class="spinner-border text-white" role="status"></div>
                            </div>
                        </a>
                    </div>
                    <div class="collapse col-12 px-0" id="order-detail-collapse">

                    </div>
                </div>
                {{-- @include('components.modals.order_detail.order_detail_pre_addon') --}}
                {{-- <div class="row px-4 px-lg-5 mb-4">
                    <div class="col-12 text-center">
                        <div class="progress progress-lg m-2" data-toggle="tooltip"
                            data-placement="top" title="Dummy Status">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h5 class="p font-14 text-dark mb-0">Status:</h5>
                        <h5 class="status-text text-dark mb-0 font-14 font-weight-medium modal-element">-</h5>
                        <div class="text-center modal-spinner">
                            <div class="spinner-border text-primary" role="status"></div>
                        </div>
                    </div>
                </div> --}}
                {{-- @include('components.modals.order_detail.order_detail_post_addon') --}}
                {{-- <div id="forwarding-order-detail-element" class="row px-4 px-lg-5 d-none hidden-container">
                    <div class="col-lg-5">
                        <div class="card my-4 shadow">
                            <div class="card-body">
                                <div class="bg-warning p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                    <div class="row m-0">
                                        <div class="col-12 m-0 p-0 align-self-center">
                                            <h5 class="mb-0 text-white text-center">Origin</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3 modal-element">
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Country of Origin</h6>
                                        <p class="text-dark font-14" id="modal-origin-country">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Airport of Origin</h6>
                                        <p class="text-dark font-14" id="modal-origin-airport">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Port of Origin</h6>
                                        <p class="text-dark font-14" id="modal-origin-port">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Place of Origin</h6>
                                        <p class="text-dark font-14" id="modal-origin-place">-</p>
                                    </div>
                                </div>
                                <div class="text-center py-4 modal-spinner">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 d-none d-lg-block text-center text-primary text-center my-auto">
                        <i data-feather="chevrons-right" class="feather-icon m-0 p-0" style="width: 40px; height: 40px;"></i>
                    </div>
                    <div class="col-lg-5">
                        <div class="card my-4 shadow">
                            <div class="card-body">
                                <div class="bg-success p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                    <div class="row m-0">
                                        <div class="col-12 m-0 p-0 align-self-center">
                                            <h5 class="mb-0 text-white text-center">Destination</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3 modal-element">
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Country of Destination</h6>
                                        <p class="text-dark font-14" id="modal-dest-country">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Airport of Destination</h6>
                                        <p class="text-dark font-14" id="modal-dest-airport">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Port of Destination</h6>
                                        <p class="text-dark font-14" id="modal-dest-port">-</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-black-50 font-14 mb-0">Place of Destination</h6>
                                        <p class="text-dark font-14" id="modal-dest-place">-</p>
                                    </div>
                                </div>
                                <div class="text-center py-4 modal-spinner">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div id="order-detail-commodities-container" class="row px-4 px-lg-5 d-none hidden-container">
                    <div class="col-12 my-4">
                        <div class="card mb-0 shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Commodities</h4>
                                    <div class="ml-auto mr-3 pr-3">
                                        <p class="font-14 text-muted pb-1 m-0 t-count modal-element" id="modal-commodities-count">0 entries</p>
                                    </div>
                                </div>
                                <div class="table-responsive modal-element">
                                    <table class="table no-wrap v-middle mb-0 w-100" id="modal-commodities-table">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0"></th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Commodity
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Qty
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Detail Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center py-4 modal-spinner">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div id="order-detail-containers-container" class="row px-4 px-lg-5 d-none hidden-container">
                    <div class="col-12 my-4">
                        <div class="card mb-0 shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Containers</h4>
                                    <div class="ml-auto mr-3 pr-3">
                                        <p class="font-14 text-muted pb-1 m-0 t-count modal-element" id="modal-containers-count">0 entries</p>
                                    </div>
                                </div>
                                <div class="table-responsive modal-element">
                                    <table class="table no-wrap v-middle mb-0 w-100" id="modal-containers-table">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0"></th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Container
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Gate In Date
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Status
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Shipping Info
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center py-4 modal-spinner">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="row px-4 px-lg-5">
                    <div class="col-12 my-4">
                        <div class="card mb-0 shadow h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Documents</h4>
                                    <div class="ml-auto mr-3 pr-3">
                                        <p class="font-14 text-muted pb-1 m-0 t-count modal-element" id="modal-documents-count">0 entries</p>
                                    </div>
                                </div>
                                <div class="table-responsive modal-element">
                                    <table class="table no-wrap v-middle mb-0 w-100" id="modal-documents-table">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0"></th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Document
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Type
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center py-4 modal-spinner">
                                    <div class="spinner-border text-primary" role="status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column no-block align-items-center mt-4 pt-3 mb-3 modal-element">
                    {{-- @include('components.modals.order_detail.cancel_order.cancel_order') --}}
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.order_detail.js_order_detail_main')
