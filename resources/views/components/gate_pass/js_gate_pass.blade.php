@push('scripts')

    <script>
        $('.select2').select2({
            width: 'resolve'
        });

        $('#form_order_gate_pass').parsley();</script>

    <script>
        var rgp = false;
        function generateGatePass(container_orders, order_type) {
            if (container_orders) {
                $('.origin-destination-label').html((order_type.toLowerCase() == 'inbound') ? 'Origin' : 'Destination');
                container_orders.forEach(function (container_order) {
                    $('#container-gate-pass-container').append(`
                        ${container_order.gate_pass ? `
                        <div class="shadow mb-2 p-2 d-flex align-items-center" style="border-radius: 8px">
                            <div class="mr-2">
                                <i class="text-muted" data-feather="package"></i>
                            </div>
                            <a href="${container_order.document_redirect ? container_order.document_redirect.document.fileUrl : 'javascript:'}" target="_blank" class="">
                                <h5 class="mb-0 text-dark font-weight-medium font-14">${container_order.container_no}</h5>
                                <p class="mb-0 font-12"><i class="fas fa-file-alt"></i> ${container_order.gate_pass}</p>
                            </a>
                        </div>
                        `:`
                        <div class="shadow mb-2 p-2 d-flex align-items-center" style="border-radius: 8px">
                            <div class="mr-2">
                                <i class="text-muted" data-feather="package"></i>
                            </div>
                            <a id="container-gate-pass-${container_order.uuid}" href="#request-gate-pass" class="" data-container-order-uuid="${container_order.uuid}" data-container-no="${container_order.container_no}" onclick="selectContainerGatePass(this)">
                                <h5 class="mb-0 text-dark font-weight-medium font-14">${container_order.container_no}</h5>
                                <p class="mb-0 font-12"><i class="fas fa-file-alt"></i> Click here to request gate pass</p>
                            </a>
                        </div>
                        `}
                    `);
                });
            }
        }

        function emptyGatePass() {
            $('#container-gate-pass-container').empty();
            $('#selected-container-gate-pass-label').empty();
            $('#request-gate-pass-input-container').addClass('d-none');
            $('#request-gate-pass-empty-banner').removeClass('d-none');
            $('.gate-pass-input').val('');
        }

        function selectContainerGatePass(elmt) {
            if (rgp) {
                var container_order_uuid = $(elmt).data('container-order-uuid');
                var container_no = $(elmt).data('container-no');
                $('.gate-pass-input').val('');
                $('#gate-pass-container-uuid').val(container_order_uuid);
                $('#selected-container-gate-pass-label').html(`
                    <div class="shadow mb-2 p-2 d-flex align-items-center" style="border-radius: 8px">
                        <div class="mr-2">
                            <i class="text-muted" data-feather="package"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 text-dark font-weight-medium font-14">${container_no}</h5>
                            <p class="mb-0 font-12"><i class="fas fa-file-alt"></i> Request gate pass available</p>
                        </div>
                    </div>
                `);
                $('#request-gate-pass-empty-banner').addClass('d-none');
                $('#request-gate-pass-input-container').removeClass('d-none');
                $('#form_order_gate_pass').parsley().reset();
                feather.replace();
            }
        }

        function requestGatePass(elmt) {
            var actionUrl = "{{ route('webapi.general.post') }}";
            var btn_html = $(elmt).html();

            $('#form_order_gate_pass').parsley().validate();
            if ($('#form_order_gate_pass').parsley().isValid()) {
                $(elmt).html('Processing <span class="spinner-border spinner-border-sm"></span>').attr('disabled', true);
                jQueryAjax(
                    actionUrl,
                    'POST',
                    new FormData(document.getElementById("form_order_gate_pass")),
                    function (data) {
                        // Success
                        addToast('Success', 'text-success', 'Gate pass requested!');
                        $('#container-gate-pass-' + $('#gate-pass-container-uuid').val())
                            .prop('href', 'javascript:')
                            .prop('onclick', '')
                            .prop('target', '_blank')
                            .find('p').addClass('text-secondary').html(`Gate pass is being processed`);
                        $('#request-gate-pass-input-container').addClass('d-none');
                        $('#request-gate-pass-empty-banner').removeClass('d-none');
                        $('.gate-pass-input').val('');
                        $('#form_order_gate_pass').parsley().reset();
                    },
                    function () {
                        // Error
                    },
                    function () {
                        // Complete
                        $(elmt).html(btn_html).attr('disabled', false);
                    },
                    true
                );
            }
        }

        function implementGatePassToggles(toggles) {
            if (toggles['order_toggle_gate_pass']) {
                $('#gate-pass-container').removeClass('d-none');
            } else {
                $('#gate-pass-container').addClass('d-none');
            }

            if (toggles['order_toggle_gate_pass_alert']) {
                $('#gate-pass-container').removeClass('bg-light').addClass('bg-warning');
                $('#gate-pass-title').html('<i data-feather="alert-circle"></i> Gate Pass');
                $('#order-detail-gate-pass-collapse').collapse('show');
                $('#request-gate-pass-container').removeClass('d-none');
                rgp = true;
            } else {
                $('#gate-pass-container').removeClass('bg-warning').addClass('bg-light');
                $('#gate-pass-title').html('Gate Pass');
                $('#request-gate-pass-container').addClass('d-none');
                rgp = false;
            }
        }
</script>

@endpush
