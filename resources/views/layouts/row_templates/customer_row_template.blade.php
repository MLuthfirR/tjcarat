@once
    @push('scripts')
        <script>
            function customerDataRowTemplate(element) {
                return [
                    `<div class="font-14">
                        <div class="text-dark font-weight-medium">${element.pic_name}</div>
                        <div class="font-12 text-secondary">${element.email ?? '-'}</div>
                        <div class="font-12 text-secondary">${element.company_phone_number ?? '-'}</div>
                    </div>`,
                    `<div class="">
                        <div class="font-14 text-dark">${element.company_name ?? '-'}</div>
                        <div class="font-12 text-secondary">${element.npwp ?? '-'}</div>
                    </div>`,
                    `<div class="font-18 text-center">${
                        element.verified
                            ? '<div><span class="text-success m-0"><i class="fas fa-check-circle"></i></span></div>'
                            :  `<div>
                                    <div class="mb-1"><span class="text-danger"><i class="fas fa-times-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-primary"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('resendVerification', '${element.pic_name}', this)">Resend Verification</button>
                                </div>`
                    }</div>`,
                    `<div class="text-center">${
                        element.active
                            ? `<div>
                                    <div class="font-14 text-success mb-1">Active <span class="font-18"><i class="fas fa-check-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-danger"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('disableAccount', '${element.pic_name}', this)">Disable Account</button>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-success"  data-uuid="${element.uuid}" onclick="orderDetail(this, 'user')">User Detail</button>
                                </div>`
                            : `<div>
                                    <div class="font-14 text-danger mb-1">Disabled <span class="font-18 m-0"><i class="fas fa-exclamation-circle"></i></span></div>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-primary"  data-uuid="${element.uuid}" onclick="triggerConfirmationModal('activateAccount', '${element.pic_name}', this)">Activate Account</button>
                                    <button type="button" class="shadow-sm btn btn-sm btn-outline-success"  data-uuid="${element.uuid}" onclick="orderDetail(this, 'user')">User Detail</button>
                                </div>`
                    }</div>`,
                ];
            }</script>
    @endpush
@endonce
