<div class="modal fade" id="confirmation-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <div class="modal-title w-100">
                    <div class="row">
                        <div class="col-10 col-sm-11">
                            <h5 class="modal-title-text modal-ticket-number text-left">Confirmation</h5>
                        </div>
                        <div class="col-2 col-sm-1">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body px-4 px-lg-5 mb-3">
                <div class="font-14 text-dark text-center">Confirm <span class="font-weight-medium" id="action-text"></span> for <span class="font-weight-medium" id="action-user-text"></span>?</div>
                <div class="d-flex justify-content-center">
                    <button type="button" id="action-btn" class="btn btn-primary shadow text-capitalize my-3" onclick="executeAction(this)"></button>
                </div>
                <div class="font-12 text-center d-none">Note: <span id="action-note-text"></span></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var action_list = {
            'resendVerification': {
                'api': 'resendVerification',
                'action_text': 'resend verification',
                'note_text': 'Resending verification will trigger current verification to expire.'
            },
            'disableAccount': {
                'api': 'disableAccount',
                'action_text': 'disable account',
                'note_text': 'Disabling account will make user unable to login.'
            },
            'activateAccount': {
                'api': 'activateAccount',
                'action_text': 'activate account',
            },
        }

        function triggerConfirmationModal(action, user_text, elmt) {
            if (action_list[action]) {
                var active_action = action_list[action];
                $('#action-text').html(active_action['action_text']);
                $('#action-user-text').html(user_text);
                $('#action-btn').html(active_action['action_text']);
                $('#action-btn').data('api', active_action['api']);
                $('#action-btn').data('uuid', $(elmt).data('uuid'));
                if (active_action['note_text']) {
                    $('#action-note-text').html(active_action['note_text']);
                    $('#action-note-text').closest('div').removeClass('d-none');
                } else {
                    $('#action-note-text').closest('div').addClass('d-none');
                }
                $('#confirmation-modal').modal('show');
            }
        }

        function executeAction(elmt) {
            var actionUrl = "{{ route('webapi.sa.post') }}";
            var btn_html = $(elmt).html();

            $(elmt).html('Processing <span class="spinner-border spinner-border-sm"></span>').attr('disabled', true);
            jQueryAjax(
                actionUrl,
                'POST',
                {
                    '_token': '{{ csrf_token() }}',
                    'api': $(elmt).data('api'),
                    'uuid': $(elmt).data('uuid'),
                },
                function (data) {
                    // Success
                    addToast('Success', 'text-success', 'Action successful!');
                    refreshAllTables();
                    $('#confirmation-modal').modal('hide');
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $(elmt).html(btn_html).attr('disabled', false);
                }
            );
        }
</script>
@endpush
