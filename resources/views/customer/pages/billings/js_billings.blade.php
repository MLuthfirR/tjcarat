@push('scripts')
    <script>
        $(document).ready(function() {
            fetchBillings(handleDataSuccess);
        });

        var fetchBillingsAjax = null;

        function clearBillings() {
            var dataTable = $("#billings-table").DataTable({
                'retrieve': true,
            });
            dataTable.clear().draw();
        }

        function refreshBillings() {
            clearBillings();
            fetchBillings(handleDataSuccess);
        }

        function formatPrice(price) {
            return formatter.format(parseInt(price || 0)) + ',00';
        }

        function fetchBillings(handleDataSuccess) {
            var dataTable = $("#billings-table").DataTable({
                'retrieve': true,
                'scrollX': true,
                "drawCallback": function() {
                    feather.replace();
                },
            });
            $('#refresh-button').addClass('fa-spin');
            $('#spinner-collapse').collapse('show');
            if (fetchBillingsAjax && fetchBillingsAjax.readyState !== 4) {
                fetchBillingsAjax.abort();
            }
            fetchBillingsAjax = jQueryAjax(
                "{{ route('webapi.customer.get') }}",
                'GET',
                {
                    "api": "fetchInvoicesByUser",
                },
                function (data) {
                    // Success
                    handleDataSuccess(data, dataTable)
                    updateLastUpdatedDate();
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    setTimeout(() => { $('#spinner-collapse').collapse('hide'); }, 350);
                    $('#refresh-button').removeClass('fa-spin');
                }
            );
        }

        function updateLastUpdatedDate() {
            $('#last-updated-date').html(moment().format('DD/MM/YYYY HH:mm:ss'));
        }

        function handleDataSuccess(data, dataTable) {
            data.forEach(element => {
                dataTable.row.add(rowTemplate(element));
            });
            dataTable.draw();
            feather.replace();
        }

        function rowTemplate(element) {
            return [
                `<div class="text-muted">
                    ${(element.is_paid) ?
                    '<i data-feather="credit-card"></i>' :
                    '<i class="text-warning" data-feather="credit-card"></i>'}
                </div>`,
                `<div class="">
                    <div class="d-flex no-block align-items-center">
                        <div class="">
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.invoice_no}</h5>
                            <p class="text-muted font-14 mb-0">Job : ${element.order ? toTitleCase(element.order.order_group) : ''} ${element.spk ? ' - ' + element.spk.spk_number : ''}</p>
                            <p class="text-muted font-14 mb-0">Ticket : ${element.order ? element.order.ticket_number : '-'}</p>
                        </div>
                    </div>
                </div>`,
                `<div class="text-muted font-14">${moment(element.created_at).format('DD/MM/YYYY')}</div>`,
                `<div class="">
                    <div class="d-flex flex-column no-block align-items-start justify-content-center">
                        <p class="status-text text-muted mb-0 font-14">${element.payment_status || 'OUTSTANDING'}</p>
                    </div>
                </div>`,
                `<div class="">
                    <div class="d-flex flex-column no-block align-items-start justify-content-center">
                        <p class="text-dark text-right mb-1 font-14 font-weight-medium">Rp${formatPrice(element.total_amount)}</p>
                        <p class="font-14 text-muted mb-0"><a href="${element.document_redirect.document.fileUrl}" target="_blank"><i data-feather="file-text"></i> Detail</a></p>
                    </div>
                </div>`,
                `<div class="d-flex flex-column">
                    ${element.is_paid ? '' : `
                        <a href="{{ route('applet.payment.index') }}${'?q=' + element.payment_key}" target="_blank" class="font-16 font-weight-medium btn btn-outline-success"><i data-feather="external-link"></i> Pay</a>
                    `}
                </div>`
            ];
        }</script>
@endpush
