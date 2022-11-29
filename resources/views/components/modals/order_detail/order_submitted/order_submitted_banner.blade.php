<div class="row mb-4 mx-4 mx-lg-5 px-3 bg-success shadow shadow-sm d-none hidden-container" style="border-radius: 8px" id="submitted-collapse-container">
    <div class="col-12 px-4 py-3 align-self-center">
        <a href="#order-detail-submitted-collapse" class="collapsed"data-toggle="collapse" aria-controls="order-detail-submitted-collapse">
            <div class="row align-items-center modal-element">
                <div class="col-10 col-lg-11">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h5 class="mb-0 text-white font-weight-medium">Ticket Submitted</h5>
                        </div>
                        <div class="col-lg-6">
                            <span class="mb-0 text-white font-14 float-lg-right">SPK Number: <span class="font-weight-medium modal-job-order-no">-</span></span>
                        </div>
                    </div>
                </div>
                <div class="col-2 col-lg-1 collapse-arrow">
                    <i class="icon text-white" data-feather="chevron-down"></i>
                </div>
            </div>
            <div class="text-center modal-spinner">
                <div class="spinner-border text-white" role="status"></div>
            </div>
        </a>
    </div>
    <div class="collapse col-12 px-3" id="order-detail-submitted-collapse">
        <div class="row px-2 mt-3">
            <div class="col-12 mb-3 text-center text-white">
                <h2 class="font-16 font-weight-medium mb-3">Order Ticket is Submitted!</h2>
                <p class="font-14 mb-2">Your order has been submitted and is being executed by <span class="font-weight-medium">IPC Logistics</span>.
                    Below is the SPK Number issued for your order.
                    We will contact you of any further updates.</p>
            </div>
            <div class="col-lg-10 offset-lg-1 mb-4">
                <div class="table-responsive">
                    <table class="table no-wrap v-middle mb-0 w-100">
                        <tbody>
                            <tr>
                                <td class="py-2 border-0">
                                    <h5 class="text-white mb-0 font-14 font-weight-medium">Order Ticket</h5>
                                </td>
                                <td class="py-2 border-0">
                                    <span class="mb-0 text-white font-14">: <span class="modal-ticket-number">-</span></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-0">
                                    <h5 class="text-white mb-0 font-14 font-weight-medium">SPK Number</h5>
                                </td>
                                <td class="py-2 border-0">
                                    <span class="mb-0 text-white font-14">: <span class="modal-job-order">-</span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        function implementTicketSubmittedCollapse(spk) {
            if (spk != null) {
                $('#submitted-collapse-container').removeClass('d-none');
            }
        }
        function implementSubmittedCollapseToggles(toggles) {
            if (toggles['order_toggle_submitted']) {
                $('#submitted-collapse-container').removeClass('d-none');
            }

            if (toggles['order_submitted_alert']) {
                $('#order-detail-submitted-collapse').collapse('show');
            } else {
                $('#order-detail-submitted-collapse').collapse('hide');
            }
        }
</script>

@endpush
