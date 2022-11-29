@push('scripts')

    <script>
        var servicesAjax = null;
        var basedOnAjax = null;

        $('.qty_price_input').on('input',function () {
            updateInputEst();
        });

        function populateServicesAndBasedOnData() {
            fetchServicesData();
            fetchBasedonData();
        }

        function fetchServicesData() {
            if (servicesAjax === null || (servicesAjax.readyState === 4 && servicesAjax.status !== 200)) {
                $('#services-container').addClass('d-none');
                $('#services-etc-container').removeClass('d-none').html('<div class="spinner-border text-white text-center" role="status"></div>');

                servicesAjax = jQueryAjax(
                    '{{ route("webapi.admin.get") }}',
                    'GET',
                    {
                        "api": "fetchServicesSelect2",
                    },
                    function (data) {
                        // Success
                        $('#service_type').select2({ data: data });
                        $('#service_type').val('').trigger('change');
                        $('#services-etc-container').addClass('d-none');
                        $('#services-container').removeClass('d-none');
                    },
                    function () {
                        // Error
                        $('#services-etc-container').removeClass('d-none').html(`
                            <div class="bg-white shadow-sm p-2 d-flex flex-column align-items-center" style="border-radius: 8px">
                                <div class="my-1 text-center">
                                    <h5 class="text-danger font-16"><i class="fas fa-times-circle"></i></h5>
                                    <h5 class="text-dark font-12 mb-0">Failed to fetch list of services.</h5>
                                </div>
                                <div class="">
                                    <a class="font-12" href="javascript:" onclick="fetchServicesData()">Retry Now</a>
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

        function fetchBasedonData() {
            if (basedOnAjax === null || (basedOnAjax.readyState === 4 && basedOnAjax.status !== 200)) {
                $('#basedon-container').addClass('d-none');
                $('#basedon-etc-container').removeClass('d-none').html('<div class="spinner-border text-white text-center" role="status"></div>');

                basedOnAjax = jQueryAjax(
                    '{{ route("webapi.admin.get") }}',
                    'GET',
                    {
                        "api": "fetchBasedonSelect2",
                    },
                    function (data) {
                        // Success
                        $('#based_on').select2({ data: data });
                        $('#based_on').val('').trigger('change');
                        $('#basedon-etc-container').addClass('d-none');
                        $('#basedon-container').removeClass('d-none');
                    },
                    function () {
                        // Error
                        $('#basedon-etc-container').removeClass('d-none').html(`
                            <div class="bg-white shadow-sm p-2 d-flex flex-column align-items-center" style="border-radius: 8px">
                                <div class="my-1 text-center">
                                    <h5 class="text-danger font-16"><i class="fas fa-times-circle"></i></h5>
                                    <h5 class="text-dark font-12 mb-0">Failed to fetch list of based on.</h5>
                                </div>
                                <div class="">
                                    <a class="font-12" href="javascript:" onclick="fetchBasedonData()">Retry Now</a>
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

        function emptyAddServiceFields() {
            $('#qty').val('');
            $('#unit_price').val('');
            $('#service_type').val('').trigger('change');
            $('#based_on').val('').trigger('change');
            $('#description').val('');
            updateInputEst();
        }

        function updateInputEst() {
            var price = $('#unit_price').val() || 0;
            var qty = $('#qty').val() || 1;
            $('#input_est_price').html(calculateFormattedEstPrice(price, qty));
        }

        function storeNewSevice() {
            var parsley_group = "quotation-add-fields";
            var tr_container = $("#modal-quotations-table").find('.quotation-list-container-create');
            var quotation = {
                'name' : $('#service_type').val(),
                'text' : $('#service_type').val(),
                'description' : $("#description").val(),
                'based_on' : $('#based_on').val(),
                'qty' : $('#qty').val(),
                'unit_price' : $('#unit_price').val(),
            };
            var tr_html = generateReadWriteQuotation(quotation, 'create');
            var emptyFields = function() {
                $('#qty').val('');
                $('#based_on').closest('div').find('.select2-selection__rendered').attr('title', 'Choose based on').html('Choose based on');
                $('#based_on').val('');
                $('#unit_price').val('');
                $('#service_type').closest('div').find('.select2-selection__rendered').attr('title', 'Choose service').html('Choose service');
                $('#service_type').val('');
                $('#description').val('');
                updateInputEst();
            };

            if ($('#description').val().trim().length < 1) {
                addToast('Error: Description required!', 'text-danger', 'Description cannot be empty.');
            } else {
                storeQuotationItem(parsley_group, tr_container, tr_html, emptyFields);
            }
        }
</script>

@endpush
