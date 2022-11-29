@push('scripts')
<script>
    $('#document-type').on('change', function() {
        $('#document-custom-type').val('');
        if (this.value !== 'Custom') {
            $('#document-custom-type').attr('required', false);
            $('#document-custom-type').attr('readonly', true);
        } else {
            $('#document-custom-type').attr('required', true);
            $('#document-custom-type').attr('readonly', false);
        }
    });

    $('#document-file-container').on('change','.custom-file-input',function () {
        var fileName = $(this).prop('files')[0].name;
        $(this).next('.custom-file-label').html(fileName);
    })

    $('#document-add-button').on('click', function() {
        $('#form_document').parsley().validate({group: 'document_input'});
        if ($('#form_document').parsley().isValid({group: 'document_input'})) {
            storeDocument();
            $('#document-modal').modal('hide');
            $('#document-file-container').prepend(`<input type="file" class="custom-file-input" id="document-file"
                                                        data-parsley-group="document_input"
                                                        data-parsley-errors-container="#document-file-container"
                                                        aria-labelledby="document-file-label" required>`);
            $('#document-file').next('label').html("Choose file...");
            $('#document-type').closest('div').find('.select2-selection__rendered').attr('title', 'Choose document type...').html('Choose document type...');
            $('#document-type').val('');
            $('#document-custom-type').val('');
        }
    });
</script>
@endpush
