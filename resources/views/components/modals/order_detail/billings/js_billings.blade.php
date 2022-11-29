@push('scripts')

    <script>
        $('.select2').select2({
            width: 'resolve'
        });</script>

    @if (Str::startsWith(Route::currentRouteName(), 'admin.'))
        <script>
            var actions_enable = false;
            var actions_admin_enable = true;</script>
    @else
        <script>
            var actions_enable = true;
            var actions_admin_enable = false;</script>
    @endif

    <script>

        function displayFormattedPrice(price) {
            return formatter.format(parseInt(price)) + ',00';
        }

        function emptyBillingsFields() {
            $('.billings-list-container').empty();
        }

        function generateBillings(billings) {
            billings.forEach(function(billing) {
                generateBillingElement(billing);
            });
        }


        function generateBillingElement(proforma) {
            $('#billings-list-container').append(`
                <tr data-proforma-uuid="${proforma.uuid}" data-invoice-uuid="${proforma.invoice ? proforma.invoice.uuid : ''}" data-invoice-no="${proforma.invoice ? proforma.invoice.invoice_no : ''}">
                    <td class="border-0 pb-0 text-dark">
                        ${proforma.invoice ? `<a href="${proforma.invoice.document_redirect.document.fileUrl}" target="_blank"><h5 class="mb-0 font-14 font-weight-medium"><i class="fas fa-file-alt"></i> ${proforma.invoice.invoice_no}</h5></a>` : '<h5 class="mb-0 font-14 font-weight-medium">Invoice N/A</h5>'}
                        <p class="mb-0 font-12">Proforma: <span><a href="${proforma.document_redirect.document.fileUrl}" target="_blank"><span class="mb-0 font-14"><i class="fas fa-file-alt"></i> ${proforma.proforma_no}</span></a></span></p>
                    </td>
                    <td class="border-0 pb-0 text-dark">
                        <h5 class="mb-0 font-14">${toTitleCase(proforma.is_cost_to_cost ? 'kwitansi' : 'invoice')}</h5>
                    </td>
                    <td class="border-0 pb-0 text-dark">
                        <h5 class="mb-0 font-14 billing-status-text">${
                            proforma.invoice ? (proforma.invoice.is_paid ? 'PAID' : '<i class="fas fa-exclamation-circle"></i> Waiting for Payment')
                                            : (proforma.is_approved ? 'Waiting for Invoice' : '<i class="fas fa-exclamation-circle font-12"></i> Outstanding')
                        }</h5>
                    </td>
                    <td class="border-0 pb-0 text-dark text-right">
                        <h5 class="mb-0 font-14">Rp${displayFormattedPrice(proforma.invoice ? proforma.invoice.total_amount : proforma.total_amount)}</h5>
                    </td>
                    ${(actions_enable && !proforma.is_approved) ? `
                        <td class="border-0 pb-0">
                            <div class="billings-action-elmt">
                                <button type="button" class="btn btn-outline-success btn-sm" onclick="acceptProforma(this)">Accept</button>
                            </div>
                        </td>
                    ` : ''}
                    ${(actions_admin_enable && proforma.invoice && !proforma.invoice.is_paid) ? `
                        <td class="border-0 pb-0">
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="triggerInvoicePaid(this)">Trigger Paid (DUMMY)</button>
                        </td>
                    ` : ''}
                </tr>
                ${actions_enable && proforma.invoice && !proforma.invoice.is_paid ? `
                    <tr>
                        <td colspan="42" class="border-0 pt-0 pb-3">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('applet.payment.index') }}${'?q=' + proforma.invoice.payment_key}" target="_blank" class="btn btn-outline-success btn-sm"><i data-feather="external-link"></i> Pay</a>
                            </div>
                        </td>
                    </tr>
                ` : ''}
            `);
            if (actions_enable && !proforma.is_approved) {
                $('.reject-proforma-container').removeClass('d-none');
            }
        }

        function implementBilllingsToggles(toggles) {
            if (toggles['order_toggle_billings']) {
                $('#billings-container').removeClass('d-none');
            } else {
                $('#billings-container').addClass('d-none');
            }

            if (toggles['order_billings_alert']) {
                $('#billings-container').removeClass('bg-light').addClass('bg-warning');
                $('#billings-title').html('<i data-feather="alert-circle"></i> Billings');
                $('#order-detail-billings-collapse').collapse('show');
            } else {
                $('#billings-container').removeClass('bg-warning').addClass('bg-light');
                $('#billings-title').html('Billings');
            }

            if (toggles['order_billings_proforma_action']) {
                $('.billings-action-elmt').removeClass('d-none');
            } else {
                $('.billings-action-elmt').addClass('d-none');
            }
        }
</script>

@endpush
