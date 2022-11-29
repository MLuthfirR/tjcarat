@props(['id', 'pic', 'actionUrl', 'defaulttype' => 'outstanding', 'headers' => ['', 'Ticket No.', 'Created Date', 'Customer', 'Location', 'Status', '' ]])

<div class="row order-table" id="order-table-{{ $id }}" data-url="{{ $actionUrl }}" data-pic="{{ $pic }}">
    <div class="col-12">
        <ul class="nav nav-tabs nav-justified mb-3" id="tabs-tab" role="tablist" data-curtype="{{ $defaulttype }}">
            {{ $list }}
        </ul>
    </div>
    <p class="text-right mb-1 mx-3 w-100 font-14">Last updated: <span id="order-table-{{ $id }}-last-updated-date">-</span> <a href="javascript:" onclick="refreshOrders(this)"><i class="fas fa-sync-alt order-table-refresh-btn" id="order-table-{{ $id }}-refresh-button"></i></a></p>
    <div class="col-12 collapse" id="order-table-{{ $id }}-spinner-collapse">
        <div class="text-center bg-white my-2 py-2">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="text-muted mb-0">Fetching data...</p>
        </div>
    </div>
    <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
            {{ $slot }}
        </div>
    </div>
</div>

@include('layouts.row_templates.index')

@push('scripts')
    <script>
        $(document).ready(function() {
            var orderTable = $("#order-table-{{ $id }}");
            fetchOrders("order-table-{{ $id }}", $(orderTable).find('.nav-tabs').data('curtype'));
        });
    </script>
@endpush

@once
    @push('scripts')
        <script>
            var fetchOrdersAjax = {};

            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                var orderTable = $(e.target).closest('.order-table');
                $(e.target).closest('.nav-tabs').data('curtype', $(e.target).data('type'));
                clearOrders($(orderTable).prop('id'), $(e.relatedTarget).data('type'));
                fetchOrders($(orderTable).prop('id'), $(e.target).data('type'));
            });

            function clearOrders(orderTableId, type) {
                if (typeof hideWarningMessages === "function") {
                    hideWarningMessages();
                }
                var dataTable = $(`#${orderTableId}-${type}-table`).DataTable({
                    'retrieve': true,
                });
                dataTable.clear().draw();
            }

            function refreshOrders(elmt) {
                var orderTable = $(elmt).closest('.order-table');
                var type = $(orderTable).find('.nav-tabs').data('curtype');
                clearOrders($(orderTable).prop('id'), type);
                fetchOrders($(orderTable).prop('id'), type);
            }

            function refreshAllTables() {
                $('.order-table-refresh-btn').trigger('click');
            }

            function fetchOrders(orderTableId, type) {
                var dataTable = $(`#${orderTableId}-${type}-table`).DataTable({
                    'retrieve': true,
                    'scrollX': true,
                    "drawCallback": function() {
                        feather.replace();
                    },
                    "rowCallback": function( row, data ) {
                        var uuid = $(row).find('.uuid-container').data('uuid');
                        if (uuid && typeof orderDetail === "function") {
                            $(row).attr('id', `order-${uuid}`).data('uuid', uuid);
                            $(row).attr("onclick", "orderDetail(this)");
                        } else {
                            $(row).css("cursor", "default");
                        }
                    }
                });
                $(`#${orderTableId}-refresh-button`).addClass('fa-spin');
                $(`#${orderTableId}-spinner-collapse`).collapse('show');
                if (fetchOrdersAjax[orderTableId] && fetchOrdersAjax[orderTableId].readyState !== 4) {
                    fetchOrdersAjax[orderTableId].abort();
                }

                var orderTable = $(`#${orderTableId}`);
                var pic = $(orderTable).data('pic');
                var actionUrl = $(orderTable).data('url');
                var actionApi = $(orderTable).find(`.tab-pane[data-type="${type}"]`).data('api');

                fetchOrdersAjax[orderTableId] = jQueryAjax(
                    actionUrl,
                    'GET',
                    { "api" : actionApi },
                    function (data) {
                        // Success
                        data.result.forEach(element => {
                            if (typeof dataRowTemplate === "function") {
                                dataTable.row.add(dataRowTemplate(element, pic));
                            }
                        });
                        dataTable.draw();
                        $('[data-toggle="tooltip"]').tooltip();
                        feather.replace();
                        if (data.counts_messages) {
                            updateOrderBadges(orderTableId, data.counts_messages.counts);
                            if (typeof handleWarningMessages === "function") {
                                handleWarningMessages(`${orderTableId}-tabs-${type}-tab`, data.counts_messages.messages);
                            }
                        }
                        updateLastUpdatedDate(orderTableId);
                    },
                    function () {
                        // Error
                        $(`#${orderTableId}`).find('.badge').html('0');
                    },
                    function () {
                        // Complete
                        $(`#${orderTableId}-refresh-button`).removeClass('fa-spin');
                        setTimeout(() => { $(`#${orderTableId}-spinner-collapse`).collapse('hide'); }, 350);
                    }
                );
            }

            function updateLastUpdatedDate(orderTableId) {
                $(`#${orderTableId}-last-updated-date`).html(moment().format('DD/MM/YYYY HH:mm:ss'));
            }

            function updateOrderBadges(orderTableId, counters) {
                var navTabs = $(`#${orderTableId}`).find('.nav-tabs');
                $(navTabs).find('.badge').html('0');

                Object.entries(counters).forEach(([key, value]) => {
                    $(navTabs).find(`.badge[data-type="${key}"]`).html(value);
                });
            }

        </script>
    @endpush
@endonce
