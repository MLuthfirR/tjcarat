@push('scripts')

<script>$(function () {
    function formatResult (data) {
        if (!data.type) {
            return data.text;
        }
        var $data = $(`<span><i class="fas fa-${data.type}"></i> ${data.text}</span>`);
        return $data;
    };

    // $('.select2').select2({
    //     width: 'resolve'
    // });


    // $('.select-output-text').on('change', function() {
    //     var selected_data = $(this).select2('data')[0].text;
    //     $(this).siblings('.select-input').val(selected_data);
    // });
});</script>

<script>$('#form_createorder').parsley();</script>

<script>
    function prepareForm() {
        var mainForm = new FormData();
        $('.table-input-file').each(function(idx, elmt) {
            var file = $(elmt).prop('files')[0];
            mainForm.append('documents[]', file, file.name);
        });
        var inputForm = jQuery(document.forms['form_createorder']).serializeArray();;
        for (var i=0; i<inputForm.length; i++)
            mainForm.append(inputForm[i].name, inputForm[i].value);

        return mainForm;
    }

    function storeOrder() {
        $('#form_createorder').parsley().validate({group: "main"});
        const requirement_fulfilled = checkRequiredDocuments();
        if ($('#form_createorder').parsley().isValid({group: "main"}) && requirement_fulfilled) {
            var mainForm = prepareForm();
            $('#submit-form').html(`Submitting <span class="spinner-border spinner-border-sm"></span>`).attr('disabled', true);

            jQueryAjax(
                '{{ route("register.store") }}',
                'POST',
                mainForm,
                function (data) {
                    // Success
                    console.log("SUCCESS");
                    console.log(data);
                    $('#success-modal').find('.main-body').html(`
                            <h3 class="text-dark font-weight-medium">User Successfully Registered</h3>`);
                    $('#success-modal').find('.button-body').html(`<a href="{{ route('login') }}" class="btn btn-outline-primary">Continue</a>`)
                    $('#success-modal').modal('show');
                },
                function (data) {
                    // Error
                    console.log("FAIL");
                    console.log(data);
                    $('#submit-form').html(`Request Order Ticket`).attr('disabled', false);
                },
                function () {
                    // Complete
                },
                true
            );
        }
    }

    function updateCount(t_body_elmt) {
        var t_count = $(t_body_elmt).closest(".card-body").find('.t-count');
        var t_count_int = $(t_body_elmt).closest(".card-body").find('.t-count-int');
        var length = $(t_body_elmt).children().length
        var table_length = length == 1 ? `${length} entry` : `${length} entries`;
        t_count_int.val(length);
        t_count.html(table_length);
    }

    function deleteItem(elmt) {
        var t_body = $(elmt).closest("tbody");
        $(elmt).closest("tr").remove();
        updateCount(t_body);
    }</script>
@endpush
