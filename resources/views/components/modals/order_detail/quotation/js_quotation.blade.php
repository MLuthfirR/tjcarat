@push('scripts')

    <script>
        $('.select2').select2({
            width: 'resolve'
        });

        $('#form_order_quotation').parsley();</script>

    {{-- General Quotation JS --}}
    <script>
        $('#form_order_quotation').on('input','.est-price',function () {
            updateEst(this);
        });

        function updateEst(elmt) {
            var tr_elmt = $(elmt).closest('tr');
            var target_elmt = $(tr_elmt).find('.target-est-price');

            var price = $(tr_elmt).find('.est-unit-price').val() || 0;
            var qty = $(tr_elmt).find('.est-qty-input').val() || 1;
            $(target_elmt).html('Rp' + calculateFormattedEstPrice(price, qty));
        }

        function calculateFormattedEstPrice(unit_price, qty) {
            return formatter.format(parseInt(unit_price || 0) * parseInt(qty || 1)) + ',00';
        }

        function baseEmptyQuotationFields() {
            $('#quotation-number').html('-');
            $('#quotation-revision').html('-');
            $('.contract-list-container').empty();
            $('.quotation-list-container').empty();
            $('.quotation-list-container-create').empty();
            $('.quotation-list-container-delete').empty();
            $('#quotation-history-list-container').empty();
            $('#submit-quotation-form').attr('disabled', true);
        }

        function generateQuotation(quotation) {
            if (quotation) {
                $('#active-quotation').removeClass('d-none');
                $('#no-active-quotation').addClass('d-none');
                $('#quotation-number').html(quotation.quotation_number || '-');
                $('#quotation-revision').html((quotation.revision_counter !== null) ? quotation.revision_counter : '-');
                specificGenerateQuotation(quotation.quotation_elements);
            } else {
                $('#active-quotation').addClass('d-none');
                $('#no-active-quotation').removeClass('d-none');
            }
            $('#quotation-container').removeClass('d-none');
        }

        function generateQuotationHistory(quotations) {
            quotations.forEach(function(quotation) {
                $('#quotation-history-list-container').append(`
                    <tr>
                        <td class="border-0 text-dark">
                            <h5 class="mb-0 font-14">${quotation.quotation_number}</h5>
                        </td>
                        <td class="border-0 text-dark">
                            <h5 class="mb-0 font-14">${quotation.is_active ? `
                                <span class="font-weight-medium">ACTIVE | ${quotation.is_final ? 'FINAL' : 'REV. ' + ((quotation.revision_counter !== null) ? quotation.revision_counter : '-')}</span>
                            ` : `REJECTED`}</h5>
                        </td>
                        <td class="border-0 text-dark">
                            <a href="${quotation.document_redirect.document.fileUrl}" target="_blank"><h5 class="mb-0 font-14"><i class="fas fa-file-alt"></i> ${quotation.document_redirect.document.fileName}</h5></a>
                        </td>
                    </tr>
                `);
            });
        }

        function generateReadOnlyQuotation(quotation) {
            return (`
                    <tr>
                        <td class="py-2 border-0">
                            <h5 class="text-dark mb-0 font-14">${quotation.text || quotation.name} ${quotation.contract_number ? '<span class="badge badge-pill badge-secondary font-12">Contract</span>' : ''}</h5>
                            <p class="font-12 text-dark mb-0" style="white-space: initial;">${quotation.description}</p>
                        </td>
                        <td class="py-2 border-0">
                            <h5 class="text-dark mb-0 font-14">${quotation.based_on}</h5>
                        </td>
                        <td class="py-2 border-0">
                            <h5 class="text-dark mb-0 font-14">${quotation.qty}<span class="text-secondary px-1">@</span>Rp${calculateFormattedEstPrice(quotation.unit_price)}</h5>
                        </td>
                        <td class="py-2 border-0">
                            <h5 class="text-right text-dark mb-0 font-14 target-est-price">Rp${calculateFormattedEstPrice(quotation.unit_price, quotation.qty)}</h5>
                        </td>
                    </tr>
                `);
        }

        function generateReadWriteQuotation(quotation, action, is_update = false) {
            return (`
                    <tr>
                        <td class="py-2 border-0 quotation-desc-td">
                            <input type="text" class="d-none" name="${action}_quotation_codes[]" value="${quotation.name}">
                            <input type="text" class="d-none" name="${action}_quotation_text[]" value="${quotation.text}">
                            <input type="text" class="d-none" name="${action}_quotation_contract_number[]" value="${quotation.contract_number ? quotation.contract_number : ''}">
                            <h5 class="text-dark mb-0 font-14">${quotation.text || quotation.name} ${quotation.contract_number ? '<span class="badge badge-pill badge-secondary font-12">Contract</span>' : ''}</h5>
                            <p class="font-12 text-dark mb-0" style="white-space: initial;">${quotation.description}</p>
                            <textarea class="form-control font-12 d-none" rows="1" name="${action}_quotation_description[]">${quotation.description}</textarea>
                        </td>
                        <td class="py-2 border-0">
                            <input  type="text"
                                    class="d-none form-control"
                                    style="min-width: 95px"
                                    name="${action}_quotation_based_on[]"
                                    data-parsley-group="quotation-submit-fields"
                                    value="${quotation.based_on}"
                                    data-parsley-errors-container="#"
                                    readonly
                                    required>
                            <h5 class="text-dark mb-0 font-14" data-value=${quotation.based_on}>${quotation.based_on}</h5>
                        </td>
                        <td class="py-2 border-0">
                            <div class="d-flex align-items-center">
                                <div class="quotation-td">
                                    <input  type="number"
                                            class="d-none form-control est-price est-qty-input"
                                            style="min-width: 95px"
                                            name="${action}_quotation_qty[]"
                                            min=0
                                            data-parsley-group="quotation-submit-fields"
                                            value="${quotation.qty}"
                                            data-parsley-errors-container="#"
                                            required>
                                    <h5 class="text-dark mb-0 font-14 est-qty-h5" data-value=${quotation.qty}>${quotation.qty}</h5>
                                </div>
                                <div class="text-secondary px-1"> @ </div>
                                <div class="quotation-td quotation-price-td">
                                    <h5 class="text-dark mb-0 font-14" data-value=${quotation.unit_price}>Rp${formatter.format(quotation.unit_price) + ',00'}</h5>
                                    <input  type="number"
                                            class="d-none form-control est-price est-unit-price"
                                            name="${action}_quotation_prices[]"
                                            value=${quotation.unit_price}
                                            placeholder="Example: 1000000"
                                            style="min-width: 95px"
                                            min=0
                                            data-parsley-group="quotation-submit-fields"
                                            data-parsley-errors-container="#"
                                            required>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 border-0">
                            <h5 class="text-right text-dark mb-0 font-14 target-est-price">Rp${calculateFormattedEstPrice(quotation.unit_price, quotation.qty)}</h5>
                        </td>
                        <td class="py-2 border-0 submit-quotation-editor">
                            <a href="javascript:" class="font-12 text-secondary mr-2 edit-quotation-btn" onclick="togglePriceEdit(this, ${quotation.contract_number ? true : false})"><i data-feather="edit"></i></a>
                            <a href="javascript:" class="font-12 text-success mr-2 save-quotation-btn d-none" onclick="togglePriceSave(this)"><i data-feather="check"></i></a>
                            <a href="javascript:" class="font-12 text-danger delete-quotation-btn" onclick=${(is_update) ? "deepDeleteItemQuotation(this)" : "deleteItemQuotation(this)"}><i data-feather="x"></i></a>
                            ${ (is_update) ? `<input type="text" class="d-none uuid-input" name="${action}_uuids[]" value="${quotation.uuid}">`: ''}
                        </td>
                    </tr>
                `);
        }

        function togglePriceEdit(elmt, is_contract=false) {
            var tr_elmt = $(elmt).closest('tr');
            var td_actions = $(tr_elmt).find('.submit-quotation-editor');

            if (is_contract) {
                $(tr_elmt).find('.est-qty-h5').addClass('d-none');
                $(tr_elmt).find('.est-qty-input').val($(tr_elmt).find('.est-qty-h5').data('value')).removeClass('d-none');
            } else {
                $(tr_elmt).find('.quotation-td').each(function() {
                    $(this).find('h5').addClass('d-none');
                    $(this).find('input').val($(this).find('h5').data('value')).removeClass('d-none');
                });

                $(tr_elmt).find('.quotation-desc-td').find('p').addClass('d-none');
                $(tr_elmt).find('.quotation-desc-td').find('textarea').removeClass('d-none');

            }

            $(td_actions).find('.save-quotation-btn').removeClass('d-none');
            $('.edit-quotation-btn').addClass('d-none');
            $('.delete-quotation-btn').addClass('d-none');
        }

        function togglePriceSave(elmt) {
            var tr_elmt = $(elmt).closest('tr');
            var td_actions = $(tr_elmt).find('.submit-quotation-editor');
            var td_price_elmt = $(tr_elmt).find('.quotation-price-td');

            $('#form_order_quotation').parsley().validate({group: "quotation-submit-fields"});
            if ($('#form_order_quotation').parsley().isValid({group: "quotation-submit-fields"})) {
                $(tr_elmt).find('.quotation-td').each(function() {
                    $(this).find('input').addClass('d-none');
                    $(this).find('h5').data('value', $(this).find('input').val()).html($(this).find('input').val()).removeClass('d-none');
                });
                $(td_price_elmt).find('h5').html('Rp' + formatter.format($(td_price_elmt).find('input').val()) + ',00');

                $(tr_elmt).find('.quotation-desc-td').find('textarea').addClass('d-none');
                $(tr_elmt).find('.quotation-desc-td').find('p').html($(tr_elmt).find('.quotation-desc-td').find('textarea').val()).removeClass('d-none');

                $(td_actions).find('.save-quotation-btn').addClass('d-none');
                $('.edit-quotation-btn').removeClass('d-none');
                $('.delete-quotation-btn').removeClass('d-none');

                $('#submit-quotation-form').attr('disabled', false);
            }
        }

        function deleteItemQuotation(elmt) {
            $(elmt).closest("tr").remove();
            $('#submit-quotation-form').attr('disabled', false);
        }

        function deepDeleteItemQuotation(elmt) {
            $('.quotation-list-container-delete').append(`
                <input type="text" class="d-none" name="delete_uuids[]" value="${$(elmt).closest("tr").find(".uuid-input").val()}">
            `);
            deleteItemQuotation(elmt)
        }
</script>

@endpush
