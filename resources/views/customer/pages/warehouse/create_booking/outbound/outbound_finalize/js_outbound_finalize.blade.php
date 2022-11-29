@push('scripts')

    <script>
        var paidthruAjax = null;

        $('.select2').select2({
            width: 'resolve'
        });

        function disableFinalBtn() {
            $('.step3-btn').attr('disabled', true);
            $('#price-detail-toggle').addClass('disabled');
        }

        function enableFinalBtn() {
            $('.step3-btn').attr('disabled', false);
            $('#price-detail-toggle').removeClass('disabled');
        }

        function resetFinalInput() {
            $('#final-container-list-table-container table tbody').empty();
            $('.final-input-hidden').remove();
            $('#paidthru-price').html('0,00');
            $('#last-updated-date').html('-');
        }

        function identifyJobType() {
            var job_type = $('#job_type').val();
            if (job_type === 'DOMESTIC') {
                return 1;
            } else if (job_type === 'OVER BRENGEN' || job_type == 'OVERBRENGEN') {
                return 2;
            }
        }

        function populateFinalInputDataCargo(job_type) {
            $('#form_outbound_finalize').append(`
                <input type="hidden" class="final-input-hidden" id="paid_thru_date" name="paid_thru_date" value="${$('#paid_thru_date_cargo').val()}">
                <input type="hidden" class="final-input-hidden" id="job_type" name="job_type" value="${job_type}">
                <input type="hidden" class="final-input-hidden" id="order_type" name="order_type" value="${'OUTBOUND'}">
                <input type="hidden" class="final-input-hidden" id="total_amount" name="total_amount" value="">
            `);
        }

        function populateFinalInputDataContainer() {
            $('#form_outbound_finalize').append(`
                <input type="hidden" class="final-input-hidden" id="paid_thru_date" name="paid_thru_date" value="${$('#paid_thru_date_container').val()}">
                <input type="hidden" class="final-input-hidden" id="job_type" name="job_type" value="${'EXPORT'}">
                <input type="hidden" class="final-input-hidden" id="order_type" name="order_type" value="${'OUTBOUND'}">
                <input type="hidden" class="final-input-hidden" id="total_amount" name="total_amount" value="">
            `);
        }

        function populateFinalTable(containers) {
            $('#final-container-list-table-container table tbody').empty();
            switch(identifyJobType()) {
                case 1:
                    // Domestic
                    populateFinalTableContainer(containers);
                    break;
                case 2:
                    // Import / OB
                    populateFinalTableBL(containers);
                    break;
            }
        }

        function populateFinalTableBL(containers) {
            containers.forEach(element => {
                insertContainerBLToTable(element);
            });
        }

        function populateFinalTableContainer(containers) {
            containers.forEach(element => {
                insertContainerContainerToTable(element);
            });
        }

        function fetchPaidthruPrice() {
            disableFinalBtn();
            $('#paidhthru-refresh-icon').addClass('fa-spin');
            $('#paidthru-price').removeClass('text-dark').addClass("text-muted");

            var containers_json_array = $('#form_outbound_finalize').serializeArray().filter(function (item) {
                    return item.name === 'yard_container_orders[]'
                });
            if (containers_json_array.length === 0) {
                addToast('Error: No containers selected', 'text-danger', 'Please select 1 or more containers to proceed with the order.');
                $('#paidhthru-refresh-icon').removeClass('fa-spin');
            } else {
                switch(identifyJobType()) {
                    case 1:
                        // Domestic
                        fetchContainerPaidthruPrice(
                            containers_json_array.map(function (item) {
                                var container = JSON.parse(item.value);
                                return {
                                    "idx": container['IDX'],
                                    "container_number": container['CONT_NO']
                                }
                            }),
                            $('#paid_thru_date').val());
                        break;
                    case 2:
                        // Import / OB
                        fetchBLPaidthruPrice(
                            $('#master_bl_number').val(),
                            $('#master_bl_date').val(),
                            $('#paid_thru_date').val());
                        break;
                    default:
                        $('#paidhthru-refresh-icon').removeClass('fa-spin');
                }
            }
        }

        function fetchContainerPaidthruPrice(containers, paid_thru_date) {
            if (paidthruAjax && paidthruAjax.readyState !== 4) {
                paidthruAjax.abort();
            }

            paidthruAjax = jQueryAjax(
                '{{ route("webapi.customer.get") }}',
                'GET',
                {
                    // TODO: Change API
                    "api": "fetchYardContainerPaidthru",
                    "containers": containers,
                    "paid_thru_date": paid_thru_date,
                },
                function (data) {
                    // Success
                    $('#paidthru-price').html(formatPrice(data.total_amount || 0)).removeClass('text-muted').addClass("text-dark");
                    $('#last-updated-date').html(moment().format('DD/MM/YYYY HH:mm:ss'));
                    $('#total_amount').val(data.total_amount);
                    enableFinalBtn();
                    emptyPriceDetail();
                    populatePriceDetailContainer(data.containers, data.total_amount);
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $('#paidhthru-refresh-icon').removeClass('fa-spin');
                }
            );
        }

        function fetchBLPaidthruPrice(bl_no, bl_date, paid_thru_date) {
            if (paidthruAjax && paidthruAjax.readyState !== 4) {
                paidthruAjax.abort();
            }

            paidthruAjax = jQueryAjax(
                '{{ route("webapi.customer.get") }}',
                'GET',
                {
                    "api": "fetchYardBLPaidthru",
                    "master_bl_number": bl_no,
                    "master_bl_date": bl_date,
                    "paid_thru_date": paid_thru_date,
                },
                function (data) {
                    // Success
                    $('#paidthru-price').html(formatPrice(data.total_amount || 0)).removeClass('text-muted').addClass("text-dark");
                    $('#last-updated-date').html(moment().format('DD/MM/YYYY HH:mm:ss'));
                    $('#total_amount').val(data.total_amount);
                    enableFinalBtn();
                    emptyPriceDetail();
                    populatePriceDetailBL(bl_no, data.charges, data.total_amount);
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $('#paidhthru-refresh-icon').removeClass('fa-spin');
                }
            );
        }

        function prepareForm() {
            var mainForm = new FormData();
            $('.table-input-file').each(function(idx, elmt) {
                var file = $(elmt).prop('files')[0];
                mainForm.append('documents[]', file, file.name);
            });
            var inputForm = jQuery(document.forms['form_outbound_finalize']).serializeArray();;
            for (var i=0; i<inputForm.length; i++)
                mainForm.append(inputForm[i].name, inputForm[i].value);

            return mainForm;
        }

        function storeYardOutboundOrder(btn_elmt) {
            $('#form_outbound_finalize').parsley().validate();
            const requirement_fulfilled = checkRequiredDocuments();
            if ($('#form_outbound_finalize').parsley().isValid() && requirement_fulfilled) {
                var mainForm = prepareForm();
                var btn_html = $(btn_elmt).html();
                $(btn_elmt).attr('disabled', true).html('Submitting <span class="spinner-border spinner-border-sm"></span>');
                jQueryAjax(
                    "{{ route('webapi.yard.booking.store.outbound') }}",
                    'POST',
                    mainForm,
                    function (data) {
                        // Success
                        $('#success-modal').find('.main-body').html(`
                            <h3 class="text-dark font-weight-medium">Booking Ticket Successfully Issued</h3>
                            <span><small>Ticket Number: </small><span>
                            <p class="text-dark">${data['ticket_number']}</p>`);
                        $('#success-modal').find('.button-body').html(`<a href="{{ route('yard.index') }}" class="btn btn-outline-primary">Continue</a>`)
                        $('#success-modal').modal('show');
                    },
                    function () {
                        // Error
                    },
                    function () {
                        // Complete
                        $(btn_elmt).attr('disabled', false).html(btn_html);
                    },
                    true
                );
            }
        }

        function insertContainerBLToTable(data) {
            if (data) {
                $('#final-container-list-table-container > table > tbody').append(`
                    <tr>
                        <td>
                            <input type="hidden" name="yard_container_orders[]" value='${JSON.stringify(data)}'>
                            <i class="ml-2 text-muted" data-feather="package"></i>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${data.CONT_NO || '-'}</h5>
                            <p class="text-muted font-14 m-0">${data.CONT_TYPE || '-'} | ${data.CONT_SIZE || '-'} | ${data.STATUS_CONT || '-'}</p>
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

        function insertContainerContainerToTable(data) {
            if (data) {
                $('#final-container-list-table-container > table > tbody').append(`
                    <tr>
                        <td>
                            <input type="hidden" name="yard_container_orders[]" value='${JSON.stringify(data)}'>
                            <i class="ml-2 text-muted" data-feather="package"></i>
                        </td>
                        <td>
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${data.CONT_NO || '-'}</h5>
                            <p class="text-muted font-14 m-0">${data.CONT_TYPE || '-'} | ${data.CONT_SIZE || '-'} | ${data.STATUS_CONT || '-'}</p>
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

</script>

@endpush
