@push('scripts')

<script>
    $(document).ready(function() {
        resetPermissionField();
        fetchPermissions();
    });

    $('#form_fetch_staff').parsley();

    $('.select2').select2({
        width: 'resolve'
    });

    var fetchUsersAjax = null;

    function handlePermissionsCheckbox(data) {
        $('#permissions-checkboxes-container').empty();
        data.forEach((element, idx) => {
            $('#permissions-checkboxes-container').append(`
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input permissions-checkboxes" id="chkbx-idx-${idx}" value="${element.name}"  name="permissions[]">
                    <label class="custom-control-label font-14" for="chkbx-idx-${idx}">${toTitleCase(element.name)}</label>
                </div>
            `);
        });
        $('#permissions-checkboxes-container').removeClass('d-none');
    }

    function resetPermissionField() {
        $('.add-staff-input').val('').trigger('change');
        $('.permissions-checkboxes').prop('checked', false);
        $('#form_fetch_staff').parsley().reset();
    }

    function fetchPermissions() {
        var actionUrl = "{{ route('webapi.sa.get') }}";
        var actionApi = "fetchAllPermissions";

        $('#permissions-checkboxes-container').addClass('d-none');
        $('#permissions-etc-container').removeClass('d-none').html('<div class="spinner-border text-secondary" role="status"></div>');

        jQueryAjax(
            actionUrl,
            'GET',
            {
                "api": actionApi,
            },
            function (data) {
                // Success
                $('#permissions-etc-container').addClass('d-none');
                handlePermissionsCheckbox(data);
            },
            function () {
                // Error
                $('#permissions-etc-container').removeClass('d-none').html(`
                    <div class="bg-light shadow-sm p-2 d-flex flex-column align-items-center" style="border-radius: 8px">
                        <div class="my-1 text-center">
                            <h5 class="text-danger font-16"><i class="fas fa-times-circle"></i></h5>
                            <h5 class="text-dark font-12 mb-0">Failed to fetch list of permissions available for staff.</h5>
                        </div>
                        <div class="">
                            <a class="font-12" href="javascript:" onclick="fetchPermissions()">Retry Now</a>
                        </div>
                    </div>
                `);
            },
            function () {
                // Complete
            }
        );
    }

    function registerStaff(elmt) {
        $('#form_fetch_staff').parsley().validate();
        if ($('#form_fetch_staff').parsley().isValid()) {
            var selected_permissions_list = $('#form_fetch_staff').serializeArray().filter(function (item) {
                return item.name == "permissions[]";
            });
            if (selected_permissions_list.length === 0) {
                addToast('Error: No permissions selected', 'text-danger', 'Please select 1 or more permissions to proceed.');
            } else {
                var actionUrl = "{{ route('webapi.sa.post') }}";
                var btn_html = $(elmt).html();

                $(elmt).html('Processing <span class="spinner-border spinner-border-sm"></span>').attr('disabled', true);
                jQueryAjax(
                    actionUrl,
                    'POST',
                    new FormData(document.getElementById("form_fetch_staff")),
                    function (data) {
                        // Success
                        $(elmt).closest('td').html('<div><span class="text-success font-18 m-0"><i class="fas fa-check-circle"></i></span></div>');
                        addToast('Success', 'text-success', 'Staff registered successfully! Please activate account by email.');
                        refreshAllTables();
                        resetPermissionField();
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
    }
</script>
@endpush
