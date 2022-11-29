@once
    @push('scripts')
        <script>
            function yardOrderRowTemplate(element, pic) {
                var container_length = element.yard_order.yard_container_orders ? element.yard_order.yard_container_orders.length : 0;
                return [
                    `<div class="text-muted alert-button-container">
                        <div class="order-group" data-group="${element.order_group}"></div>
                        ${(element.status && (element.status.pic == pic)) ?
                        '<i class="text-warning order-group-icon" data-feather="map"></i>' :
                        '<i class="order-group-icon" data-feather="map"></i>'}
                    </div>`,
                    `<div class="">
                        <div class="d-flex no-block align-items-center">
                            <div class="">
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.ticket_number}</h5>
                                <p class="text-muted font-14 mb-0">${toTitleCase(element.yard_order.order_type)} - ${element.yard_order.job_type}</p>
                                <p class="text-muted font-14 mb-0">${container_length + (container_length == 1 ? " Container" : " Containers")}</p>
                            </div>
                        </div>
                    </div>`,
                    `<div class="text-muted font-14">${moment(element.created_at).format('DD/MM/YYYY')}</div>`,
                    `<div class="text-muted font-14">${element.user.company_name}</div>`,
                    `<div class="">
                        <div class="text-muted font-14">${element.yard_order.yard}</div>
                        <p class="text-secondary font-12 font-weight-medium mb-0">Gate ${toTitleCase(element.yard_order.order_type).split('bound')[0]}: ${moment(element.yard_order.paid_thru_date).format('DD/MM/YYYY')}</div>
                    </div>`,
                    `<div class="">
                        <div class="d-flex flex-column no-block align-items-center">
                            <div class="progress progress-md mx-2 mb-2" style="width:120px" data-toggle="tooltip"
                                data-placement="top" title="${element.status ? element.status.name : '-'}">
                                <div class="progress-bar bg-${element.status ? element.status.progress_type : 'warning'} progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${element.status ? element.status.percentage : '0%'}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="status-text text-muted mb-0 font-14 ${(element.status && (element.status.pic == pic)) ? 'd-none' : ''}">${element.status ? element.status.name : '-'}</p>
                            <button type="button" class="td-button btn btn-outline-${(element.status && element.status.progress_type && element.status.progress_type == 'danger') ? element.status.progress_type : 'warning'} btn-sm mb-1 action-required-btn ${(element.status && (element.status.pic == pic)) ? '' : 'd-none'}" onclick="orderDetail(this.closest('tr'), 'yard')">${element.status ? element.status.name : 'Action Required!'}</button>
                            ${element.active_task_exists ? `<button type="button" class="td-button btn btn-outline-warning btn-sm mt-2" onclick="orderDetail(this.closest('tr'), 'yard')">${'Outstanding Task(s)!'}</button>` : ''}
                        </div>
                    </div>`,
                    `<div class="uuid-container" data-uuid="${element.uuid}">
                        <a href="javascript:" class="font-12 pb-1"><i data-feather="external-link"></i></a>
                    </div>`
                ];
            }</script>
    @endpush
@endonce
