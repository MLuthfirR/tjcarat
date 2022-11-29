<div class="row collapse mb-4 mx-4 mx-lg-5 px-3 bg-danger shadow shadow-sm" id="order-detail-proforma-rejected-collapse" style="border-radius: 8px">
    <div class="col-12 px-3">
        <div class="row px-2 mt-3">
            <div class="col-12 mb-3 py-3 text-center text-white">
                <h2 class="font-16 font-weight-medium mb-3">Proforma is rejected by customer.</h2>
                @yield('proforma_rejected_action')
                <p class="font-14 mb-2 proforma-rejected-customer-text">The current proforma is rejected by customer.
                    Please wait and cooperate with our staff for creation and approval of modified quotation and proforma.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        function implementProformaRejectedToggles(toggles) {
            if (toggles['order_toggle_proforma_rejected']) {
                $('#order-detail-proforma-rejected-collapse').collapse('show');
            } else {
                $('#order-detail-proforma-rejected-collapse').collapse('hide');
            }
        }</script>

@endpush
