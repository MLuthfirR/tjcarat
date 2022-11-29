@once
    @push('scripts')
        <script>
            function staffDataRowTemplate(element) {
                return [
                    `<div class="font-14">
                        <div class="text-dark font-weight-medium">${element.name}</div>
                        <div class="font-12 text-secondary">${element.email}</div>
                        <div class="font-12 text-secondary">${element.phone_number}</div>
                    </div>`,
                    `<div class="font-14 text-secondary">${element.roles ? toTitleCase(element.roles[0].name) : ''}</div>`,
                    `<div>
                        <div class="font-12 text-secondary mb-1">${element.permissions ? element.permissions.map(function(value) {
                            return toTitleCase(value.name) + '<br>';
                        }) : ''}</div>
                        <button type="button" class="shadow-sm btn btn-sm btn-outline-primary font-12"  data-uuid="${element.uuid}" onclick="">Change Permission</button>
                    </div>`,
                    `<div class="font-18 text-center">${
                        element.verified
                            ? '<div><span class="text-success m-0"><i class="fas fa-check-circle"></i></span></div>'
                            :  `<div>
                                    <div class="mb-1"><span class="text-danger m-0"><i class="fas fa-times-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-primary"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('resendVerification', '${element.name}', this)">Resend Verification</button>
                                </div>`
                    }</div>`,
                    `<div class="text-center">${
                        element.active
                            ? `<div>
                                    <div class="font-14 text-success mb-1">Active <span class="font-18"><i class="fas fa-check-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-danger"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('disableAccount', '${element.name}', this)">Disable Account</button>
                                </div>`
                            : `<div>
                                    <div class="font-14 text-danger mb-1">Disabled <span class="font-18 m-0"><i class="fas fa-exclamation-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-primary"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('activateAccount', '${element.name}', this)">Activate Account</button>
                                </div>`
                    }</div>`,
                ];
            }</script>
    @endpush
@endonce
