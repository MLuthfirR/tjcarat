@once
    @push('scripts')
        <script>
            function forwardingOrderRowTemplate(element, pic) {
                var commodity_length = element.forwarding_order.commodities ? element.forwarding_order.commodities.length : 0;
                return [
                    `<div class="text-muted alert-button-container">
                        <div class="order-group" data-group="${element.order_group}"></div>
                        ${(element.status && (element.status.pic == pic)) ?
                        '<i class="text-warning" data-feather="navigation"></i>' :
                        '<i data-feather="navigation"></i>'}
                    </div>`,
                    `<div class="">
                        <div class="d-flex no-block align-items-center">
                            <div class="">
                                <h5 class="text-dark mb-0 font-16 font-weight-medium">${element.ticket_number}</h5>
                                <p class="text-muted font-14 mb-0">${toTitleCase(element.forwarding_order.order_type)} - ${element.forwarding_order.container_type}</p>
                                <p class="text-muted font-14 mb-0">${commodity_length + (commodity_length == 1 ? " Commodity" : " Commodities")}</p>
                            </div>
                        </div>
                    </div>`,
                    `<div class="text-muted font-14">${moment(element.created_at).format('DD/MM/YYYY')}</div>`,
                    `<div class="text-muted font-14">${element.user.company_name}</div>`,
                    `<div class="">
                        <div class="d-inline-flex align-items-center">
                            <div class="btn btn-warning rounded-circle btn-circle font-12" data-toggle="tooltip"
                                data-placement="top" title="${element.forwarding_order.country_of_origin || element.forwarding_order.place_of_origin || 'Origin'}">${(element.forwarding_order.country_of_origin || element.forwarding_order.place_of_origin || 'Origin').trim().substring(0,3).toUpperCase()}</div>
                            <div class="d-flex justify-content-center mx-2">
                                <i data-feather="chevrons-right"></i>
                            </div>
                            <div class="btn btn-primary rounded-circle btn-circle font-12" data-toggle="tooltip"
                                data-placement="top" title="${element.forwarding_order.country_of_destination || element.forwarding_order.place_of_destination || 'Destination'}">${(element.forwarding_order.country_of_destination || element.forwarding_order.place_of_destination || 'Destination').trim().substring(0,3).toUpperCase()}</div>
                        </div>
                    </div>`,
                    `<div class="">
                        <div class="d-flex flex-column no-block align-items-center">
                            <div class="progress progress-md mx-2 mb-2" style="width:120px" data-toggle="tooltip"
                                data-placement="top" title="${element.status ? element.status.name : '-'}">
                                <div class="progress-bar bg-${element.status ? element.status.progress_type : 'warning'} progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${element.status ? element.status.percentage : '0%'}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="status-text text-muted mb-0 font-14 ${(element.status && (element.status.pic == pic)) ? 'd-none' : ''}">${element.status ? element.status.name : '-'}</p>
                            <button type="button" class="td-button btn btn-outline-${(element.status && element.status.progress_type && element.status.progress_type == 'danger') ? element.status.progress_type : 'warning'} btn-sm mb-1 action-required-btn ${(element.status && (element.status.pic == pic)) ? '' : 'd-none'}" onclick="orderDetail(this.closest('tr'), 'forwarding')">${element.status ? element.status.name : 'Action Required!'}</button>
                            ${element.active_task_exists ? `<button type="button" class="td-button btn btn-outline-warning btn-sm mb-1" onclick="orderDetail(this.closest('tr'), 'forwarding')">${'Outstanding Task(s)!'}</button>` : ''}
                        </div>
                    </div>`,
                    `<div class="uuid-container" data-uuid="${element.uuid}">
                        <a href="javascript:" class="font-12 pb-1"><i data-feather="external-link"></i></a>
                    </div>`
                ];
            }</script>
    @endpush
@endonce
