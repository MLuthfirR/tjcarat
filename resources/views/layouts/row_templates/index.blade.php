@once

    @include('layouts.row_templates.forwarding_row_template')
    @include('layouts.row_templates.yard_row_template')
    @include('layouts.row_templates.customer_row_template')
    @include('layouts.row_templates.staff_row_template')

    @push('scripts')
        <script>
            function dataRowTemplate(data, pic) {
                if (pic == 'sa-customer') {
                    return customerDataRowTemplate(data);
                } else if (pic == 'sa-staff') {
                    return staffDataRowTemplate(data);
                } else if (data.order_group == 'forwarding') {
                    return forwardingOrderRowTemplate(data, pic);
                } else if (data.order_group == 'yard') {
                    return yardOrderRowTemplate(data, pic);
                }
                // TODO: Warehouse
            }
        </script>
    @endpush

@endonce
