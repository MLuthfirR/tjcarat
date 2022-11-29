@push('scripts')

    <script>
        $('#form_container').parsley();
        $('#form_cargo').parsley();

        function disableFetchBtn() {
            $('.step1-btn').attr('disabled', true);
        }

        function enableFetchBtn() {
            $('.step1-btn').attr('disabled', false);
        }

        function populateInputDataCargo() {
            $('.job-type-text').html($('#input_job_type').val());
            $('.paid-thru-text').html($('#paid_thru_date_cargo').val());

            $('.cargo-section').removeClass('d-none');
            $('.container-section').addClass('d-none');

            if ($('#input_job_type').val() === 'IMPORT') {
                $('.import-section').removeClass('d-none');
            } else {
                $('.import-section').addClass('d-none');
            }

            populateFinalInputDataCargo($('#input_job_type').val());
            toggleInputSPPBDocument();
        }

        function populateInputDataContainer() {
            $('.job-type-text').html('EXPORT');
            $('.paid-thru-text').html($('#paid_thru_date_container').val());

            $('.cargo-section').addClass('d-none');
            $('.import-section').addClass('d-none');
            $('.container-section').removeClass('d-none');

            populateFinalInputDataContainer();
        }

        function fetchContainer() {
            var btn_html = $('#form-container-btn').html();
            $('#form_container').parsley().validate();
            if ($('#form_container').parsley().isValid()) {
                disableFetchBtn();
                resetAll();
                $('#form-container-btn').html('Fetching <span class="spinner-border spinner-border-sm"></span>');
                jQueryAjax(
                    apiUrl,
                    'POST',
                    new FormData(document.getElementById("form_container")),
                    function (data) {
                        // Success
                        populateInputDataContainer();
                        populateSelectTableContainer(data);
                        enableSelectBtn();
                        advanceStep(2);
                        addToast('Success', 'text-success', 'Container data fetched successfully');
                    },
                    function () {
                        // Error
                    },
                    function () {
                        // Complete
                        $('#form-container-btn').html(btn_html);
                        enableFetchBtn();
                    },
                    true
                );
            }
        }

        function fetchCargo() {
            var btn_html = $('#form-cargo-btn').html();
            $('#form_cargo').parsley().validate();
            if ($('#form_cargo').parsley().isValid()) {
                resetAll();
                $('#form-cargo-btn').html('Processing <span class="spinner-border spinner-border-sm"></span>');
                populateInputDataCargo();
                advanceStep(2);
                $('#form-cargo-btn').html(btn_html);
            }
        }</script>

@endpush
