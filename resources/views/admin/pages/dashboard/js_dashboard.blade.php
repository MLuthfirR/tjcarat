
@push('scripts')
    <script src="{{ asset('assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/chartist-plugin-legend/chartist-plugin-legend.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#greetings-title').html('Good ' + getGreetingTime(moment()) + ', {{ $user->name }}');
        });

        $(function () {
            // ==============================================================
            // Chart Customer
            // ==============================================================
            var chart_customer = new Chartist.Line('#customer-stats', {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    JSON.parse(atob("{{ base64_encode(json_encode($customers_per_month)) }}")),
                ]
            }, {
                low: 0,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip(),
                    Chartist.plugins.legend({
                        legendNames: JSON.parse(atob("{{ base64_encode(json_encode($customers_stats_legend)) }}")),
                        position: document.getElementById('customer-chart-legend-container')
                    })
                ],
                axisY: {
                    onlyInteger: true,
                    scaleMinSpace: 40,
                    offset: 20,
                },
            });

            // Offset x1 a tiny amount so that the straight stroke gets a bounding box
            chart_customer.on('draw', function (ctx) {
                if (ctx.type === 'area') {
                    ctx.element.attr({
                        x1: ctx.x1 + 0.001
                    });
                }
            });

            // Create the gradient definition on created event (always after chart re-render)
            chart_customer.on('created', function (ctx) {
                var defs = ctx.svg.elem('defs');
                defs.elem('linearGradient', {
                    id: 'gradient',
                    x1: 0,
                    y1: 1,
                    x2: 0,
                    y2: 0
                }).elem('stop', {
                    offset: 0,
                    'stop-color': 'rgba(255, 255, 255, 1)'
                }).parent().elem('stop', {
                    offset: 1,
                    'stop-color': 'rgba(80, 153, 255, 1)'
                });
            });

            $(window).on('resize', function () {
                chart_customer.update();
            });


            // ==============================================================
            // Chart Order
            // ==============================================================
            var chart = new Chartist.Line('#order-stats', {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    JSON.parse(atob("{{ base64_encode(json_encode($orders_per_month)) }}")),
                    JSON.parse(atob("{{ base64_encode(json_encode($orders_per_month_ff)) }}")),
                    JSON.parse(atob("{{ base64_encode(json_encode($orders_per_month_warehouse)) }}")),
                    JSON.parse(atob("{{ base64_encode(json_encode($orders_per_month_yard)) }}")),
                ]
            }, {
                low: 0,
                fullWidth: true,
                plugins: [
                    Chartist.plugins.tooltip(),
                    Chartist.plugins.legend({
                        legendNames: JSON.parse(atob("{{ base64_encode(json_encode($orders_stats_legend)) }}")),
                        position: document.getElementById('chart-legend-container')
                    })
                ],
                axisY: {
                    onlyInteger: true,
                    scaleMinSpace: 40,
                    offset: 20,
                },
            });

            // Offset x1 a tiny amount so that the straight stroke gets a bounding box
            chart.on('draw', function (ctx) {
                if (ctx.type === 'area') {
                    ctx.element.attr({
                        x1: ctx.x1 + 0.001
                    });
                }
            });

            // Create the gradient definition on created event (always after chart re-render)
            chart.on('created', function (ctx) {
                var defs = ctx.svg.elem('defs');
                defs.elem('linearGradient', {
                    id: 'gradient',
                    x1: 0,
                    y1: 1,
                    x2: 0,
                    y2: 0
                }).elem('stop', {
                    offset: 0,
                    'stop-color': 'rgba(255, 255, 255, 1)'
                }).parent().elem('stop', {
                    offset: 1,
                    'stop-color': 'rgba(80, 153, 255, 1)'
                });
            });

            $(window).on('resize', function () {
                chart.update();
            });
        });</script>

@endpush
