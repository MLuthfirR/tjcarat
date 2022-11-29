@push('scripts')

    <script>
    function specificGenerateQuotation(quotations = []) {
        quotations.forEach(function(quotation) {
            $('.quotation-list-container').append(generateReadOnlyQuotation(quotation));
        });
    }

    function emptyQuotationFields() {
        baseEmptyQuotationFields();
    }

    function implementQuotationToggles(toggles) {
        if (toggles['approve_quotation']) {
            $('#approve-quotation-form').removeClass('d-none');
        } else {
            $('#approve-quotation-form').addClass('d-none');
        }

        if (toggles['quotation_alert']) {
            $('#quotation-container').removeClass('bg-light').addClass('bg-warning');
            $('#quotation-title').html('<i data-feather="alert-circle"></i> Order Quotation');
            $('#order-detail-quotation-collapse').collapse('show');
        } else {
            $('#quotation-container').removeClass('bg-warning').addClass('bg-light');
            $('#quotation-title').html('Order Quotation');
        }
    }</script>

@endpush
