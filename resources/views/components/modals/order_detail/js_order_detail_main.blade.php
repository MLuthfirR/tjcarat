@push('scripts')

    <script>
        var orderDetailApiType = {
            'user': 'fetchUserByUuid',
            'yard': 'fetchYardOrderByUuid',
        };

        $('#order-detail-modal-main').on('hidden.bs.modal', function (e) {
            clearOrderDetail(this);
            $(this).find('.modal-title-text').html('Order Detail');
            $('#last-updated-detail-date').html('-');
        });

        var orderDetailAjax = null;

        function clearOrderDetail(elmt) {
            $(elmt).find('.collapse').collapse('hide');
            $(elmt).find('.hidden-container').addClass('d-none');
            $(elmt).find('.progress-bar').css('width', '0%');
            $('#quotation-container').removeClass('bg-warning').addClass('bg-light');

            $('.modal-spinner').removeClass('d-none');
            $('.modal-element').addClass('d-none');
        }

        function refreshOrderDetail(elmt) {
            clearOrderDetail($(elmt).closest('.modal'));
            setTimeout(() => { orderDetail(elmt, $(elmt).data('type')); }, 200);
        }

        function orderDetail(elmt, type=null) {
            console.log($(elmt).data());
            if (type == null) {
                type = $(elmt).find('.order-group').data('group');
            }
            $('#refresh-detail-button').addClass('fa-spin');
            $('#refresh-detail-button').closest('a').data('uuid', $(elmt).data('uuid'));
            $('#refresh-detail-button').closest('a').data('type', type);
            $('.modal-spinner').removeClass('d-none');
            $('.modal-element').addClass('d-none');
            $('#order-detail-modal-main').modal('show');

            if (orderDetailAjax && orderDetailAjax.readyState !== 4) {
                orderDetailAjax.abort();
            }

            orderDetailAjax = jQueryAjax(
                '{{ route("webapi.general.get") }}',
                'GET',
                {
                    'api': orderDetailApiType[type],
                    'uuid': $(elmt).data('uuid')
                },
                function (data) {
                    // Success
                    // console.log(data);
                    $('#modal-customer-id').val(data.id);
                    $('.modal-order-uuid-input').val(data.uuid);
                    $('.modal-ticket-number').html(data.company_name);
                    $("#modal-documents-table > tbody > tr").remove();
                    populateForwardingOrderDetail(data);

                    $('#modal-documents-count').html(data.documents ? data.documents.length + (data.documents.length == '1' ? ' entry' : ' entries') : '0 entries');
                    data.documents.forEach(element => {
                        $('#modal-documents-table > tbody').append(`
                            <tr>
                                <td class="py-4 text-muted"><i data-feather="file-text"></i></td>
                                <td class="py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <a href="${element.fileUrl}" target="_blank">
                                            <h5 class="mb-0 font-14">${element.fileName}</h5>
                                        </a>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-14 font-weight-medium">${element.documentType}</h5>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        `)
                    });
                    feather.replace();
                    // generateBillings(data.billing_proformas);
                    // implementStatusUpdate(data.uuid, data.status);
                    // implementToggles(data.toggles);
                    updateLastUpdatedDetailDate();
                    $('#refresh-detail-button').removeClass('fa-spin');
                    $('.modal-spinner').addClass('d-none');
                    $('.modal-element').removeClass('d-none');

                    if (typeof fetchTasksData === "function") {
                        fetchTasksData();
                    }
                },
                function () {
                    // Error
                    $('.modal-spinner').addClass('d-none');
                    $('#refresh-detail-button').removeClass('fa-spin');
                },
                function () {
                    // Complete
                }
            );
        }

        function populateForwardingOrderDetail(data) {
            $('.modal-job-order-no').html(data.spk ? data.spk.spk_number : '-');
            $('.modal-job-order').html(data.spk ? `
            ${data.spk.spk_number} | ${data.spk.document_redirect
                                            ? ` <a href="${data.spk.document_redirect.document.fileUrl}" target="_blank">
                                                    <span class="mb-0 font-14"><i class="fas fa-file-alt"></i> File</span>
                                                </a>`
                                            : '-'}`
            : '-');
            $('#order-detail-collapse').html(`
                <div class="row pt-0 pb-4 px-3">
                    <div class="col-lg-7 my-2">
                        <div class="bg-primary p-3 shadow shadow-sm h-100" style="border-radius: 8px">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Created Date</h6>
                                    <p class="text-white font-weight-medium font-14" id="modal-date">${moment(data.created_at).format('DD/MM/YYYY')}</p>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Company Email</h6>
                                    <p class="text-white font-weight-medium font-14" id="modal-order-type">${data.email ? toTitleCase(data.email) : '-'}</p>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Company Phone number</h6>
                                    <p class="text-white font-weight-medium font-14 mb-0" id="modal-container-type">${data.company_phone_number || '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 my-2">
                        <div class="bg-light p-3 shadow shadow-sm h-100" style="border-radius: 8px">
                            <div class="row m-0">
                                <div class="col-12 m-0 p-0 align-self-center">
                                    <h5 class="mb-0 text-dark text-center font-weight-medium">Customer</h5>
                                </div>
                            </div>
                            <div class="row pt-4 pb-0 px-3 modal-element">
                                <div class="col-12">
                                    <div class="mb-2">
                                        <p class="text-dark font-14 text-break font-weight-medium mb-0" id="modal-cust-company">${data.company_name || '-'}</p>
                                        <p class="text-dark font-14 text-break mb-0" id="modal-cust-npwp">${data.npwp || '-'}</p>
                                    </div>
                                    <p class="text-dark font-14 text-break font-weight-medium mb-0">PIC:</p>
                                    <div class="mb-0 p-2 bg-light shadow shadow-sm" style="border-radius: 8px">
                                        <p class="text-dark font-12 text-break mb-0" id="modal-cust-name">${data.pic_name || '-'}</p>
                                        <p class="text-dark font-12 text-break mb-0" id="modal-cust-email">${data.email || '-'}</p>
                                        <p class="text-dark font-12 text-break mb-0" id="modal-cust-phone">${data.pic_title || '-'}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            // $('#modal-origin-country').html(data.forwarding_order.country_of_origin || '-');
            // $('#modal-origin-airport').html(data.forwarding_order.airport_of_loading || '-');
            // $('#modal-origin-port').html(data.forwarding_order.port_of_loading || '-');
            // $('#modal-origin-place').html(data.forwarding_order.place_of_origin || '-');
            // $('#modal-dest-country').html(data.forwarding_order.country_of_destination || '-');
            // $('#modal-dest-airport').html(data.forwarding_order.airport_of_destination || '-');
            // $('#modal-dest-port').html(data.forwarding_order.port_of_destination || '-');
            // $('#modal-dest-place').html(data.forwarding_order.place_of_destination || '-');

            // $('#modal-commodities-count').html(data.forwarding_order.commodities ? data.forwarding_order.commodities.length + (data.forwarding_order.commodities.length == '1' ? ' entry' : ' entries') : '0 entries');
            // data.forwarding_order.commodities.forEach(element => {
            //     $('#modal-commodities-table > tbody').append(`
            //         <tr>
            //             <td class="py-4 text-muted"><i data-feather="package"></i></td>
            //             <td class="py-4">
            //                 <div class="d-flex no-block align-items-center">
            //                     <div class="">
            //                         <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.commodity}</h5>
            //                         <p class="text-muted font-12 mb-0">Volume: <span>${element.volume || '-'} ${element.volume_unit || ''}</span></p>
            //                         <p class="text-muted font-12 mb-0">Weight: <span>${element.weight || '-'} ${element.weight_unit || ''}</span></p>
            //                     </div>
            //                 </div>
            //             </td>
            //             <td class="py-4">
            //                 <div class="d-flex no-block align-items-center">
            //                     <div class="">
            //                         <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.qty} <span class="text-muted font-14">${element.unit}</span></h5>
            //                     </div>
            //                 </div>
            //             </td>
            //             <td class="py-4">
            //                 <p class="m-0 p-0 overflow-auto text-wrap text-muted font-14" style="width: 150px; max-height: 70px">
            //                     ${element.description}
            //                 </p>
            //             </td>
            //         </tr>
            //     `)
            // });

            $('#forwarding-order-detail-element').removeClass('d-none');
            $('#order-detail-commodities-container').removeClass('d-none');

            // generateQuotation(data.forwarding_order.current_quotation);
            // generateQuotationHistory(data.forwarding_order.quotations);
            // implementTicketSubmittedCollapse(data.spk);
        }

        function populateYardOrderDetail(data) {
            $('#order-detail-collapse').html(`
                <div class="row pt-0 pb-4 px-3">
                    <div class="col-lg-6 my-2">
                        <div class="bg-primary p-3 shadow shadow-sm h-100" style="border-radius: 8px">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Yard Location</h6>
                                    <p class="text-white font-weight-medium font-14" id="modal-order-yard-location">${data.yard_order.yard ? toTitleCase(data.yard_order.yard) : '-'}</p>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Gate ${toTitleCase((data.yard_order.order_type).split('bound')[0])} Date</h6>
                                    <p class="text-white font-weight-medium font-14" id="modal-date">${moment(data.yard_order.paid_thru_date).format('DD/MM/YYYY')}</p>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Order Type</h6>
                                    <p class="text-white font-weight-medium font-14" id="modal-order-type">${data.yard_order.order_type ? toTitleCase(data.yard_order.order_type) : '-'}</p>
                                </div>
                                <div class="col-12">
                                    <h6 class="text-white font-14 mb-0">Job Type</h6>
                                    <p class="text-white font-weight-medium font-14 mb-0" id="modal-job-type">${data.yard_order.job_type ? toTitleCase(data.yard_order.job_type) : '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 my-2">
                        <div class="bg-light p-3 shadow shadow-sm h-100" style="border-radius: 8px">
                            <div class="row m-0">
                                <div class="col-12 m-0 p-0 align-self-center">
                                    <h5 class="mb-0 text-dark text-center font-weight-medium">Customer</h5>
                                </div>
                            </div>
                            <div class="row pt-4 pb-0 px-3 modal-element">
                                <div class="col-12">
                                    <p class="text-dark font-14 text-break font-weight-medium mb-0" id="modal-cust-company">${data.user.company_name || '-'}</p>
                                    <p class="text-dark font-14 text-break mb-2" id="modal-cust-npwp">${data.user.npwp || '-'}</p>
                                    <p class="text-dark font-14 text-break mb-0" id="modal-cust-name">${data.user.name || '-'}</p>
                                    <p class="text-dark font-14 text-break mb-0" id="modal-cust-email">${data.user.email || '-'}</p>
                                    <p class="text-dark font-14 text-break mb-0" id="modal-cust-phone">${data.user.phone_number || '-'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            $('#modal-containers-count').html(data.yard_order.yard_container_orders ? data.yard_order.yard_container_orders.length + (data.yard_order.yard_container_orders.length == '1' ? ' entry' : ' entries') : '0 entries');
            data.yard_order.yard_container_orders.forEach(element => {
                $('#modal-containers-table > tbody').append(`
                    <tr>
                        <td class="py-3">
                            <i class="text-muted" data-feather="package"></i>
                        </td>
                        <td class="py-3">
                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.container_no || '-'}</h5>
                            <p class="text-muted font-14 m-0">${element.container_type || '-'} | ${element.container_size || '-'} | ${element.status_container || '-'}</p>
                        </td>
                        <td class="py-3">
                            <h5 class="text-dark mb-0 font-14">${element.gate_in_date ? moment(element.gate_in_date).format('DD/MM/YYYY') : '-'}</h5>
                        </td>
                        <td class="py-3">
                            <h5 class="text-dark mb-0 font-14">${element.status_man || '-'}</h5>
                        </td>
                        <td class="py-3">
                            <h5 class="text-dark mb-0 font-14 font-weight-medium">B/L No.: ${element.master_bl_number || '-'}</h5>
                            <p class="text-muted font-14 m-0">Consignee: ${element.consignee || '-'}</p>
                            <p class="text-muted font-14 m-0">Vessel / Voyage: ${element.vessel || '-'} / ${element.voyage || '-'}</p>
                            <p class="text-muted font-14 m-0">Terminal: ${element.terminal || '-'}</p>
                            <p class="text-muted font-14 m-0">Shipping Line: ${element.shipping_line || '-'}</p>
                            <p class="text-muted font-14 m-0">ETA: ${element.eta_date ? moment(element.eta_date).format('DD/MM/YYYY') : '-'}</p>
                        </td>
                    </tr>
                `)
            });
            $('#order-detail-containers-container').removeClass('d-none');

            if (typeof generateGatePass === "function") {
                generateGatePass(data.yard_order.yard_container_orders, data.yard_order.order_type);
            }
        }

        function updateLastUpdatedDetailDate() {
            $('#last-updated-detail-date').html(moment().format('DD/MM/YYYY HH:mm:ss'));
        }

        function baseUpdateStatus(elmt, action, actionUrl, actionApi) {
            var htmlBuffer = $(elmt).html();
            var uuid = $(elmt).closest('tr').data('uuid') || $('.modal-order-uuid-input').val();
            $(elmt).html(`Updating <span class="spinner-border spinner-border-sm"></span>`).attr('disabled', true);
            jQueryAjax(
                actionUrl,
                'POST',
                {
                    "_token": "{{ csrf_token() }}",
                    "api": actionApi[action],
                    "uuid" : uuid
                },
                function (data) {
                    // Success
                    addToast('Success!', 'text-success', 'Status update successful.');
                    implementStatusUpdate(uuid, data.status);
                    implementToggles(data.toggles);
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

        function baseImplementToggles(toggles, should_update_modal=true) {
            if (should_update_modal) {
                implementQuotationToggles(toggles);
                implementBilllingsToggles(toggles);
                implementSubmittedCollapseToggles(toggles);
                implementCompletedOrderToggles(toggles);
                implementProformaRejectedToggles(toggles);

                if (toggles['admin_toggle_order_open']) {
                    $('#order-detail-collapse').collapse('show');
                }
            }

            feather.replace();
        }

        function baseImplementStatusUpdate(type, order_uuid, status, should_update_modal=true) {
            var tr = $(`#order-${order_uuid}`);
            tr.find('.progress').attr('data-original-title', status.name);
            tr.find('.status-text').html(status.name);
            tr.find('.action-required-btn').html(status.name);
            tr.find('.progress-bar').removeClass('bg-success bg-danger bg-warning').addClass('bg-' + (status.progress_type ? status.progress_type : 'warning'));
            tr.find('.progress-bar').css('width', (status.percentage ? status.percentage : '0%'));

            if (status.pic === type) {
                tr.find('.status-text').addClass('d-none');
                tr.find('.action-required-btn').removeClass('d-none');
                tr.find('.order-group-icon').addClass('text-warning');
            } else {
                tr.find('.status-text').removeClass('d-none');
                tr.find('.action-required-btn').addClass('d-none');
                tr.find('.order-group-icon').removeClass('text-warning');
            }

            if (should_update_modal) {
                $('#order-detail-modal-main').find('.progress').attr('data-original-title', status.name);
                $('#order-detail-modal-main').find('.status-text').html(status.name);
                $('#order-detail-modal-main').find('.progress-bar').removeClass('bg-success bg-danger bg-warning').addClass('bg-' + (status.progress_type ? status.progress_type : 'warning'));
                $('#order-detail-modal-main').find('.progress-bar').css('width', (status.percentage ? status.percentage : '0%'));
            }

            feather.replace();
            $('[data-toggle="tooltip"]').tooltip();
        }</script>

@endpush
