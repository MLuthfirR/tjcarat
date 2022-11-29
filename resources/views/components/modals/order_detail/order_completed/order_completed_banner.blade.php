<div class="row collapse mb-4 mx-4 mx-lg-5 px-3 bg-success shadow shadow-sm" id="order-detail-order-completed-collapse" style="border-radius: 8px">
    <div class="col-12 px-3">
        <div class="row px-2 mt-3">
            <div class="col-12 mb-3 py-3 text-center text-white">
                <h2 class="font-16 font-weight-medium mb-3">Order is completed!</h2>
                <p class="font-14 mb-2">Your order has been successfully completed! Thank you for using <span class="font-weight-medium">IPC Logistics</span> as your logistics solution.</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        function implementCompletedOrderToggles(toggles) {
            if (toggles['order_toggle_completed']) {
                $('#order-detail-order-completed-collapse').collapse('show');
            } else {
                $('#order-detail-order-completed-collapse').collapse('hide');
            }
        }</script>

@endpush
