@push('scripts')

    <script>
        $('#form_container').parsley();
        $('#form_bl').parsley();

        function disableFetchBtn() {
            $('.step1-btn').attr('disabled', true);
        }

        function enableFetchBtn() {
            $('.step1-btn').attr('disabled', false);
        }

        function populateInputDataBL() {
            $('.job-type-text').html('OVER BRENGEN');
            $('.bl-no-text').html($('#input_master_bl_number').val());
            $('.bl-date-text').html($('#input_master_bl_date').val());
            $('.paid-thru-text').html($('#paid_thru_date_bl').val());

            $('.bl-section').removeClass('d-none');
            $('.container-section').addClass('d-none');

            populateFinalInputDataBL();
            fetchBLSPPBDocument($('#input_master_bl_number').val(), $('#input_master_bl_date').val());
        }

        function populateInputDataContainer() {
            $('.job-type-text').html('DOMESTIC');
            $('.paid-thru-text').html($('#paid_thru_date_container').val());

            $('.bl-section').addClass('d-none');
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

        function fetchBL() {
            var btn_html = $('#form-bl-btn').html();
            $('#form_bl').parsley().validate();
            if ($('#form_bl').parsley().isValid()) {
                disableFetchBtn();
                resetAll();
                $('#form-bl-btn').html('Fetching <span class="spinner-border spinner-border-sm"></span>');
                jQueryAjax(
                    apiUrl,
                    'POST',
                    new FormData(document.getElementById("form_bl")),
                    function (data) {
                        // Success
                        populateInputDataBL();
                        populateSelectTableBL(data);
                        advanceStep(2);
                        addToast('Success', 'text-success', 'BL data fetched successfully');
                    },
                    function () {
                        // Error
                    },
                    function () {
                        // Complete
                        $('#form-bl-btn').html(btn_html);
                        enableFetchBtn();
                    },
                    true
                );
            }
        }</script>

@endpush
