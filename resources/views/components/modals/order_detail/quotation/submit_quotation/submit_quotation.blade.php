<button type="button" id="submit-quotation-form" class="btn btn-primary btn-block" onclick="storeQuotation()" disabled>
    Submit Quotation
</button>

@push('scripts')

    <script>
        function storeQuotation() {
            $('#form_order_quotation').parsley().validate({group: "quotation-submit-fields"});
            if ($('#form_order_quotation').parsley().isValid({group: "quotation-submit-fields"})) {
                $('#submit-quotation-form').html(`Submitting <span class="spinner-border spinner-border-sm"></span>`).attr('disabled', true);
                jQueryAjax(
                    submit_quotation_url || '',
                    'POST',
                    new FormData(document.getElementById("form_order_quotation")),
                    function (data) {
                        // Success
                        emptyQuotationFields();
                        generateQuotation(data.quotation);
                        generateQuotationHistory(data.quotation_history);
                        implementToggles(data.toggles);
                        implementStatusUpdate($('.modal-order-uuid-input').val(), data.status);
                        addToast('Success', 'text-success', data.message);
                    },
                    function () {
                        // Error
                        $('#submit-quotation-form').attr('disabled', false);
                    },
                    function () {
                        // Complete
                        $('#submit-quotation-form').html(`Submit Quotation`);
                    },
                    true
                );
            }
        }</script>

@endpush
