<form action="" method="POST" id="form_outbound_finalize">
    @csrf
    <input type="hidden" name="api" value="storeYardOrder">
    <div class="row px-0 px-lg-3 font-14">
        <div class="col-12">
            <div class="bg-white p-3 mb-3 shadow-sm" style="border-radius: 8px">
                <div class="row m-0">
                    <div class="col-12 m-0 px-sm-2 px-md-5 py-2 align-self-center d-flex flex-column">
                        <div class="mb-3 border-bottom border-secondary w-100 align-self-center">
                            <h5 class="text-dark text-center font-18"><span class="font-weight-medium">Your Order</span></h5>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-secondary font-14">Job Type</h6>
                            <p class="mb-0 text-dark font-weight-medium font-16 input-text job-type-text"></p>
                        </div>
                        <div class="bl-section">
                            <div class="mb-3">
                                <h6 class="mb-0 text-secondary font-14">B/L No.</h6>
                                <p class="mb-0 text-dark font-weight-medium font-16 input-text bl-no-text"></p>
                            </div>
                            <div class="mb-3">
                                <h6 class="mb-0 text-secondary font-14">B/L Date</h6>
                                <p class="mb-0 text-dark font-weight-medium font-16 input-text bl-date-text"></p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-0 text-secondary font-14">Paid Thru Date</h6>
                            <p class="mb-0 text-dark font-weight-medium font-16 input-text paid-thru-text"></p>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-2 text-secondary font-14">Container List</h6>
                            <div class="shadow bg-white" style="max-height: 400px; overflow: auto; border-radius: 8px;">
                                <div class="table-responsive" id="final-container-list-table-container">
                                    <table class="table table-required no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0"></th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Container
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Yard
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
                            </div>
                        </div>
                        <div class="mb-3 mt-2">
                            <h6 class="mb-0 text-secondary font-14">Total Price</h6>
                            <p class="mb-0 text-dark font-weight-medium font-18">Rp<span class="text-muted" id="paidthru-price">0,00</span> <a href="javascript:" onclick="fetchPaidthruPrice()" class="font-weight-normal"><i class="fas fa-sync-alt" id="paidhthru-refresh-icon"></i></a>
                                <a class="btn btn-sm btn-outline-primary font-weight-normal ml-3 disabled" id="price-detail-toggle" href="javascript:" data-toggle="modal" data-target="#price-detail-modal">Detail</a>
                            </p>
                            <p class="font-12 mb-0">Last updated: <span id="last-updated-date">-</span></p>
                            <p class="font-12">Please <a href="javascript:" onclick="fetchPaidthruPrice()">refresh</a> to get the latest price estimation and enable confirm order.</p>
                        </div>
                    </div>
                    <div class="col-12 px-0 px-lg-3">
                        <div class="card mb-4 px-0 px-lg-3">
                            <div class="card-body">
                                <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                    <div class="row m-0">
                                        <div class="col-sm-6 m-0 p-0 align-self-center">
                                            <h5 class="mb-sm-0 text-white">Documents</h5>
                                        </div>
                                        <div class="col-sm-6 m-0 p-0 align-self-center">
                                            <h6 class="mb-0 text-white float-sm-right"><i class="fas fa-file-alt"></i></h6>
                                        </div>
                                    </div>
                                </div>
                                @include('customer.components.create_ticket_components.documents_create.documents_create')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-wrap mt-5 justify-content-center">
                <button type="button" class="btn btn-primary step3-btn order-2 mx-2 mt-2" onclick="storeYardOutboundOrder(this)" disabled>Confirm Order</button>
                <button type="button" class="btn btn-secondary order-1 mx-2 mt-2" onclick="gotoStep(2)"><i class="fas fa-chevron-left"></i> Back</button>
            </div>
            <p class="mb-0 mt-0 mt-md-2 text-center font-12">Order cannot be changed after confirming order, and will be processed to payment immediately.</p>
            <div class="d-flex mt-2 justify-content-center">
                <button type="button" class="btn btn-outline-danger border-0" onclick="resetButton()">Reset</button>
            </div>
        </div>
    </div>
</form>
@include('customer.pages.yard.create_booking.outbound.outbound_finalize.price_detail_modal.price_detail_modal')
@include('components.modals.document_uploader.document_uploader_modal')
@include('components.modals.success.success_modal')

@include('customer.pages.yard.create_booking.outbound.outbound_finalize.js_outbound_finalize')
