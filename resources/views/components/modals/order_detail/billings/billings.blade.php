<div class="row mb-4 mx-4 mx-lg-5 px-3 bg-light shadow shadow-sm d-none hidden-container" style="border-radius: 8px" id="billings-container">
    <div class="col-12 px-4 py-3 align-self-center">
        <a href="#order-detail-billings-collapse" class="collapsed"data-toggle="collapse" aria-controls="order-detail-billings-collapse">
            <div class="row align-items-center modal-element">
                <div class="col-10 col-lg-11">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h5 class="mb-0 text-dark font-weight-medium" id="billings-title">Billings</h5>
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
    <div class="collapse col-12 px-3" id="order-detail-billings-collapse">
        <form id="form_order_billings" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input class="d-none modal-order-uuid-input" name="order_uuid">
            <div class="row px-2">
                <div class="col-12 mb-3">
                    <p class="text-dark font-12 mb-2">
                        List of proforma invoices and invoices issued for your order. Please review and make payments on invoices to complete the order.
                    </p>
                </div>
                <div class="col-12 mb-3 px-0">
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0 w-100" id="modal-billings-table">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0 font-14 font-weight-medium text-dark py-0">Billing
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-dark py-0">Type
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-dark py-0">Status
                                    </th>
                                    <th class="border-0 font-14 font-weight-medium text-dark text-right py-0">Total Price
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="billings-list-container" id="billings-list-container">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @yield('billings-action')
        </form>
    </div>
</div>

@include('components.modals.order_detail.billings.js_billings')
