@push('scripts')
    <script>
        var sppbAjax = null;

        function disableSelectBtn() {
            $('.step2-btn').attr('disabled', true);
        }

        function enableSelectBtn() {
            $('.step2-btn').attr('disabled', false);
        }

        function resetAllSelectElmt() {
            $('#container-list-table-container table tbody').empty();
            $('.input-text').html('');
        }

        function finalizeOrder() {
            var containers_json_array = $('#container_list_form').serializeArray();
            if (containers_json_array.length === 0) {
                addToast('Error: No containers selected', 'text-danger', 'Please select 1 or more containers to proceed with the order.');
            } else {
                populateFinalTable(
                    containers_json_array.map(function (item) {
                        return JSON.parse(item.value)
                    })
                );
                fetchPaidthruPrice();
                advanceStep(3);
            }
        }

        function fetchBLSPPBDocumentFromInput() {
            fetchBLSPPBDocument($('#master_bl_number').val(), $('#master_bl_date').val());
        }

        function fetchBLSPPBDocument(bl_no, bl_date) {
            disableSelectBtn();
            $('.doc-collapse').collapse('hide');
            $('#document-icon-container').html(`<div class="spinner-border text-dark" role="status"></div>`);
            if (sppbAjax && sppbAjax.readyState !== 4) {
                sppbAjax.abort();
            }

            sppbAjax = jQueryAjax(
                '{{ route("webapi.customer.get") }}',
                'GET',
                {
                    "api": "fetchYardBLSPPB",
                    "bl_number": bl_no,
                    "bl_date": bl_date,
                },
                function (data) {
                    // Success
                    populateDocumentData(data);
                    enableSelectBtn();
                    $('#document-icon-container').html(`<h3 class="text-success m-0"><i class="fas fa-check-circle"></i></h3>`);
                    $('#document-summary-collapse').collapse('show');
                },
                function () {
                    // Error
                    $('#document-icon-container').html(``);
                    $('#document-failed-collapse').collapse('show');
                },
                function () {
                    // Complete
                }
            );
        }

        function fetchContainerData(elmt) {
            var htmlBuffer = $(elmt).html();
            $(elmt).attr('disabled', true);
            $(elmt).html('<span class="spinner-border spinner-border-sm"></span>');

            jQueryAjax(
                '{{ route("webapi.customer.get") }}',
                'GET',
                {
                    "api": "fetchYardContainerService",
                    "container_number" : $('#additional_container_number').val(),
                },
                function (data) {
                    // Success
                    insertContainerToTable(data);
                    $('#additional_container_number').val('');
                    addToast('Success!', 'text-success', 'Fetch data successful!');
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $(elmt).html(htmlBuffer).attr('disabled', false);
                }
            );
        }

        function populateDocumentData(data) {
            $('.sppb-no-text').html(data.no_sppb);
            $('.pib-no-text').html(data.no_pib);
            $('#document-detail-collapse > table').html(`
                <tr>
                    <td>
                        <h5 class="mb-0 text-dark font-14">Car</h5>
                    </td>
                    <td>
                        <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium">${data.car || '-'}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="mb-0 text-dark font-14">Cargo Owner</h5>
                    </td>
                    <td>
                        <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium">${data.nm_cargoowner || '-'}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="mb-0 text-dark font-14">FF</h5>
                    </td>
                    <td>
                        <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium">${data.nm_ff || '-'}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="mb-0 text-dark font-14">SPPB Date</h5>
                    </td>
                    <td>
                        <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium">${data.tgl_sppb || '-'}</span></h5>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h5 class="mb-0 text-dark font-14">PIB Date</h5>
                    </td>
                    <td>
                        <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium">${data.tgl_pib || '-'}</span></h5>
                    </td>
                </tr>
            `);
        }

        function populateSelectTableBL(containers) {
            containers.forEach(element => {
                insertBLContainerToTable(element);
            });
            $('#container-list-note').html('Note: Payment must be done on all active containers registered on the B/L.');
        }

        function populateSelectTableContainer(container) {
            insertContainerToTable(container);
        }

        // DUMMY FUNCTION
        // function insertBLContainerToTable(data) {
        //     if (data) {
        //         $('#container-list-table-container > table > tbody').append(`
        //             <tr class="">
        //                 <td>
        //                     <input type="checkbox" name="containers[]" value='${JSON.stringify(data)}'
        //                             data-parsley-required="true"
        //                             data-parsley-mincheck="1"
        //                             data-parsley-errors-container="#container-list-table-container"
        //                             data-parsley-error-message="At least one container must be selected" checked>
        //                     <i class="ml-2 text-muted" data-feather="package"></i>
        //                 </td>
        //                 <td>
        //                     <h5 class="text-dark mb-0 font-16 font-weight-medium">${data.CONT_NO || '-'}</h5>
        //                     <p class="text-muted font-14 m-0">${data.CONT_TYPE || '-'} | ${data.CONT_SIZE || '-'} | ${data.STATUS_CONT || '-'}</p>
        //                     ${(data.STATUS_MAN == 'GATE OUT' && data.GATE_OUT_DATE !== null)
        //                         ? `<h5 class="text-secondary mb-0 font-14 font-weight-medium">Gate Out at ${data.GATE_OUT_DATE}</h5>`
        //                         : ''
        //                     }
        //                 </td>
        //                 <td>
        //                     <h5 class="text-dark mb-0 font-14">${data.YARD || '-'}</h5>
        //                 </td>
        //                 <td>
        //                     <h5 class="text-dark mb-0 font-14">${data.GATE_IN_DATE || '-'}</h5>
        //                 </td>
        //                 <td>
        //                     <h5 class="text-dark mb-0 font-14">${data.STATUS_MAN || '-'}</h5>
        //                 </td>
        //                 <td>
        //                     <h5 class="text-dark mb-0 font-14 font-weight-medium">Consignee: ${data.CONSIGNEE || '-'}</h5>
        //                     <p class="text-muted font-14 m-0">Vessel / Voyage: ${data.VESSEL || '-'} / ${data.VOYAGE || '-'}</p>
        //                     <p class="text-muted font-14 m-0">Terminal: ${data.TERMINAL || '-'}</p>
        //                     <p class="text-muted font-14 m-0">ETA: ${data.ETA_DATE || '-'}</p>
        //                 </td>
        //             </tr>
        //         `);
        //         feather.replace();
        //     }
        // }

        function insertContainerToTable(data) {
            if (data) {
                $('#container-list-table-container > table > tbody').append(`
                    <tr class="${(data.STATUS_MAN == 'GATE OUT')
                                ? 'bg-light'
                                : ''}">
                        <td>
                            ${(data.STATUS_MAN == 'GATE OUT')
                                ? '' : ` <input type="checkbox" name="containers[]" value='${JSON.stringify(data)}'
                                    data-parsley-required="true"
                                    data-parsley-mincheck="1"
                                    data-parsley-errors-container="#container-list-table-container"
                                    data-parsley-error-message="At least one container must be selected" checked>`
                                }
                            <i class="ml-2 text-muted" data-feather="package"></i>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${data.CONT_NO || '-'}</h5>
                            <p class="text-muted font-14 m-0">${data.CONT_TYPE || '-'} | ${data.CONT_SIZE || '-'} | ${data.STATUS_CONT || '-'}</p>
                            ${(data.STATUS_MAN == 'GATE OUT')
                                ? `<h5 class="text-secondary mb-0 font-14 font-weight-medium">Gate Out at ${data.GATE_OUT_DATE || '-'}</h5>`
                                : ''
                            }
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.YARD || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.GATE_IN_DATE || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.STATUS_MAN || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14 font-weight-medium">B/L No.: ${data.MASTER_BL_NO || '-'}</h5>
                            <p class="text-muted font-14 m-0">Shipping Line: ${data.SHIP_LINE || '-'}</p>
                            <p class="text-muted font-14 m-0">Vessel: ${data.VESSEL || '-'}</p>
                        </td>
                    </tr>
                `);
                feather.replace();
            }
        }

        function insertBLContainerToTable(data) {
            if (data) {
                $('#container-list-table-container > table > tbody').append(`
                    <tr class="${(data.STATUS_MAN == 'GATE OUT' && data.GATE_OUT_DATE !== null)
                                ? 'bg-light'
                                : ''}">
                        <td>
                            ${(data.STATUS_MAN == 'GATE OUT' && data.GATE_OUT_DATE !== null)
                                ? '' : ` <input type="checkbox" name="containers[]" value='${JSON.stringify(data)}'
                                    data-parsley-required="true"
                                    data-parsley-mincheck="1"
                                    data-parsley-errors-container="#container-list-table-container"
                                    data-parsley-error-message="At least one container must be selected" checked>`
                                }
                            <i class="ml-2 text-muted" data-feather="package"></i>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${data.CONT_NO || '-'}</h5>
                            <p class="text-muted font-14 m-0">${data.CONT_TYPE || '-'} | ${data.CONT_SIZE || '-'} | ${data.STATUS_CONT || '-'}</p>
                            ${(data.STATUS_MAN == 'GATE OUT' && data.GATE_OUT_DATE !== null)
                                ? `<h5 class="text-secondary mb-0 font-14 font-weight-medium">Gate Out at ${data.GATE_OUT_DATE}</h5>`
                                : ''
                            }
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.YARD || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.GATE_IN_DATE || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14">${data.STATUS_MAN || '-'}</h5>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-14 font-weight-medium">Consignee: ${data.CONSIGNEE || '-'}</h5>
                            <p class="text-muted font-14 m-0">Vessel / Voyage: ${data.VESSEL || '-'} / ${data.VOYAGE || '-'}</p>
                            <p class="text-muted font-14 m-0">Terminal: ${data.TERMINAL || '-'}</p>
                            <p class="text-muted font-14 m-0">ETA: ${data.ETA_DATE || '-'}</p>
                        </td>
                    </tr>
                `);
                feather.replace();
            }
        }
</script>

@endpush
