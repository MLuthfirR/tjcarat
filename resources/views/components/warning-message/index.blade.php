@once
    <div class="" id="warning-messages-container">

    </div>

    @push('scripts')
        <script>
            function showTab(tab_id) {
                $('#'+tab_id).tab('show');
            }

            function hideWarningMessages() {
                $('.warning-message-collapse').collapse('hide');
            }

            function resetWarningMessages() {
                $('#warning-messages-container').empty();
            }

            function insertWarningMessage(text, tabs_target, route="javascript:") {
                $('#warning-messages-container').append(`
                    <div class="mb-3">
                        <div class="collapse px-3 bg-warning shadow-sm warning-message-collapse" style="border-radius: 8px">
                            <div class="row px-4 py-3">
                                <div class="col-2 col-md-1 d-md-flex align-items-center pt-1 pt-md-0">
                                    <h4 class="mb-0 text-dark font-weight-medium"><i data-feather="alert-circle"></i></h4>
                                </div>
                                <div class="col-10 col-md-11">
                                    <div class="row">
                                        <div class="col-md-10 d-flex align-items-center">
                                            <p class="mb-0 text-dark font-14">${text || '-'}</p>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="${route}" class="btn btn-sm btn-outline-primary float-md-right" onclick="showTab('${tabs_target}')">Go</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            }

            function showWarningMessages() {
                feather.replace();
                $('.warning-message-collapse').collapse('show');
            }

            function handleWarningMessages(target_id, data) {
                resetWarningMessages();
                if (data) {
                    data.forEach(element => {
                        insertWarningMessage(element.message, target_id, '#'+target_id);
                    });
                    showWarningMessages();
                }
            }
    </script>
    @endpush
@endonce
