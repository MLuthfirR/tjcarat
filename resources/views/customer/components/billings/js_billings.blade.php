@push('scripts')

    <script>


        function acceptProforma(elmt) {
            var htmlBuffer = $(elmt).html();
            var tr_elmt = $(elmt).closest('tr');
            var uuid = $(tr_elmt).data('proforma-uuid');
            $(elmt).html(`<span class="spinner-border spinner-border-sm"></span>`).attr('disabled', true);
            jQueryAjax(
                '{{ route("webapi.customer.post") }}',
                'POST',
                {
                    "_token": "{{ csrf_token() }}",
                    "api": "acceptProforma",
                    "uuid" : uuid
                },
                function (data) {
                    // Success
                    addToast('Success!', 'text-success', 'Proforma accepted');
                    $(elmt).closest('td').addClass('d-none');
                    $(tr_elmt).find('.billing-status-text').html('Waiting for Invoice');
                    implementStatusUpdate(uuid, data.status);
                    implementToggles(data.toggles);
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $(elmt).html(htmlBuffer).attr('disabled', false);
                }
            );
        }

        function rejectProforma(elmt) {
            var htmlBuffer = $(elmt).html();
            var uuid = $('.modal-order-uuid-input').val();
            $(elmt).html(`<span class="spinner-border spinner-border-sm"></span>`).attr('disabled', true);
            jQueryAjax(
                '{{ route("webapi.customer.post") }}',
                'POST',
                {
                    "_token": "{{ csrf_token() }}",
                    "api": "rejectProforma",
                    "uuid" : uuid
                },
                function (data) {
                    // Success
                    addToast('Success!', 'text-success', 'Proforma rejected');
                    implementStatusUpdate(uuid, data.status);
                    implementToggles(data.toggles);
                },
                function () {
                    // Error
                },
                function () {
                    // Complete
                    $(elmt).html(htmlBuffer).attr('disabled', false);
                }
            );
        }


</script>

@endpush
