@push('scripts')

    <script>
        var contractServicesAjax = null;

        $('.contract_qty_price_input').on('input',function () {
            updateContractInputEst();
        });

        $('#contract_type').on('change', function() {
            var selected_data = $('#contract_type').select2('data')[0];
            $('#contract-data-container').html('');
            if (selected_data && selected_data.id && selected_data.id !== "") {
                $('#contract-data-container').html(`
                    <div class="col-12 bg-white shadow-sm border border-secondary p-2" style="border-radius:8px">
                        <h5 class="text-dark font-14 font-weight-medium mb-0">${selected_data.id} <span class="badge badge-pill badge-secondary font-12">Contract</span></h5>
                        <h6 class="text-dark font-12">${selected_data.description}</h6>
                        <h6 class="text-dark font-12 mb-0">Based On: ${selected_data.based_on}</h6>
                        <h5 class="text-dark font-14 mb-0">@ Rp${calculateFormattedEstPrice(selected_data.amount)}</h5>
                        <input type="hidden" id="contract_unit_price" value="${selected_data.amount}">
                    </div>
                `);
                $('#contract-data-container').collapse('show');
            }
            updateContractInputEst();
        })

        function populateContractServicesData() {
            fetchContractServicesData();
        }

        function fetchContractServicesData() {
            if ((contractServicesAjax === null) || (contractServicesAjax.readyState === 4)) {
                var customer_id = $('#modal-customer-id').val();
                $('#contract-container').addClass('d-none');
                $('#contract-data-container').collapse('hide');
                $('#contract-etc-container').removeClass('d-none').html('<div class="spinner-border text-white text-center" role="status"></div>');

                contractServicesAjax = jQueryAjax(
                    '{{ route("webapi.admin.get") }}',
                    'GET',
                    {
                        "api": "fetchContractServices",
                        "customer_id": customer_id,
                    },
                    function (data) {
                        // Success
                        $('#contract_type').select2({ data: data });
                        $('#contract_type').val('').trigger('change');
                        $('#contract-etc-container').addClass('d-none');
                        $('#contract-container').removeClass('d-none');
                    },
                    function () {
                        // Error
                        $('#contract-etc-container').removeClass('d-none').html(`
                            <div class="bg-white shadow-sm p-2 d-flex flex-column align-items-center" style="border-radius: 8px">
                                <div class="my-1 text-center">
                                    <h5 class="text-danger font-16"><i class="fas fa-times-circle"></i></h5>
                                    <h5 class="text-dark font-12 mb-0">Failed to fetch list of contract services.</h5>
                                </div>
                                <div class="">
                                    <a class="font-12" href="javascript:" onclick="fetchContractServicesData()">Retry Now</a>
                                </div>
                            </div>
                        `);
                    },
                    function () {
                        // Complete
                    }
                );
            }
        }

        function emptyAddContractFields() {
            $('#contract-data-container').collapse('hide');
            $('#contract-data-container').html('');
            $('#contract_input_qty').val('');
            $('#contract_type').val('').trigger('change');
            updateContractInputEst();
        }

        function updateContractInputEst() {
            var price = $('#contract_unit_price').val() || 0;
            var qty = $('#contract_input_qty').val() || 1;
            $('#input_contract_est_price').html(calculateFormattedEstPrice(price, qty));
        }

        function storeQuotationContractItem() {
            var parsley_group = "quotation-contract-add-fields";
            var tr_container = $("#modal-quotations-table").find('.quotation-list-container-create');
            var selected_data = $('#contract_type').select2('data')[0];
            var quotation = {
                'name' : $('#contract_type').val(),
                'text' : $('#contract_type').val(),
                'description' : selected_data.description,
                'based_on' : selected_data.based_on,
                'qty' : $('#contract_input_qty').val(),
                'unit_price' : selected_data.amount,
                'contract_number' : selected_data.contract_number,
            };
            var tr_html = generateReadWriteQuotation(quotation, 'create');
            var emptyFields = function() {
                emptyAddContractFields();
            };
            storeQuotationItem(parsley_group, tr_container, tr_html, emptyFields);
        }
</script>

@endpush
