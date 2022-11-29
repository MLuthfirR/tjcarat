<div class="row mb-4 mx-4 mx-lg-5 px-3 bg-light shadow shadow-sm d-none hidden-container" style="border-radius: 8px" id="quotation-container">
    <div class="col-12 px-4 py-3 align-self-center">
        <a href="#order-detail-quotation-collapse" class="collapsed"data-toggle="collapse" aria-controls="order-detail-quotation-collapse">
            <div class="row align-items-center modal-element">
                <div class="col-10 col-lg-11">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5 class="mb-0 text-dark font-weight-medium" id="quotation-title">Order Quotation</h5>
                        </div>
                        <div class="col-lg-6">
                            <span class="mb-0 text-dark font-14 float-lg-right"><span class="font-weight-medium" id="quotation-number">-</span> | Revision <span class="font-weight-medium" id="quotation-revision">-</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-lg-1 collapse-arrow">
                    <i class="icon text-secondary" data-feather="chevron-down"></i>
                </div>
            </div>
            <div class="text-center modal-spinner">
                <div class="spinner-border text-dark" role="status"></div>
            </div>
        </a>
    </div>
    <div class="collapse col-12 px-3" id="order-detail-quotation-collapse">
        <div id="active-quotation">
            <form id="form_order_quotation" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <input class="d-none modal-order-uuid-input" name="order_uuid">
                <div class="row px-2">
                    <div class="col-12 mb-3">
                        @yield('quotation-description')
                    </div>
                    <div class="col-12 mb-3 px-0">
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0" id="modal-quotations-table">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-dark py-2">Service
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-dark py-2">Based on
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-dark py-2">Qty @ Unit Price
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-dark text-right py-2">Est. Price
                                        </th>
                                        <th class="border-0 font-14 py-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="contract-list-container border-0">
                                </tbody>
                                <tbody class="quotation-list-container border-0">
                                </tbody>
                                <tbody class="quotation-list-container-create border-0">
                                </tbody>
                                <div class="quotation-list-container-delete d-none">
                                </div>
                            </table>
                        </div>
                    </div>
                    @yield('quotation-addon')
                </div>
                <div class="row px-2">
                    @yield('quotation-action')
                </div>
            </form>
        </div>
        <div class="row px-2" id="no-active-quotation">
            <div class="col-12 mb-3 text-center text-dark">
                <h5 class="font-16 font-weight-medium">No Active Quotation</h5>
            </div>
            @yield('quotation-no-active')
        </div>
        <div class="p-5 px-2 text-center d-none" id="quotation-spinner">
            <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status"></div>
        </div>
        <div class="row px-2">
            <div class="col-12 pb-3 align-self-center collapse-arrow">
                <a href="#quotation-history" class="collapsed" data-toggle="collapse" aria-controls="quotation-history">
                    <div class="collapse-arrow">
                        <p class="mb-0 text-dark text-center font-14" id="quotation-title">Quotation History
                            <i class="icon text-secondary" data-feather="chevron-down"></i></p>
                    </div>
                </a>
            </div>
            <div class="collapse col-12" id="quotation-history">
                <div class="table-responsive mb-3">
                    <table class="table no-wrap v-middle mb-0 w-100" id="quotation-history-table">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0 font-14 font-weight-medium text-dark py-0">Quotation No.
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-dark py-0">Status
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-dark py-0">Document
                                </th>
                            </tr>
                        </thead>
                        <tbody id="quotation-history-list-container">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.order_detail.quotation.js_quotation')
