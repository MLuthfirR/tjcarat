<div class="row px-0 px-lg-3">
    <div class="col-12 px-3 mb-3 font-14">
        @if (isset($required_documents) && !empty(json_decode($required_documents)))
            <h5 class="text-dark req-docs font-14">Required Document(s)<span class='text-danger'>*</span> :</h5>
            @foreach (json_decode($required_documents) as $required_document)
                <p class="text-dark mx-3 req-docs mb-0">- <span class="font-weight-medium">{{ $required_document->text }}</span></p>
            @endforeach
            <p class="text-danger d-none font-12 mt-2" id="required-documents-error">Please upload all the required documents</p>
        @endif
    </div>
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h4 class="card-title">Documents</h4>
                    <div class="ml-auto mr-3 pr-3">
                        <p class="font-14 text-muted pb-1 m-0 t-count" id="table-count">0 entries</p>
                    </div>
                </div>
                <div class="table-responsive" id="document-table-container">
                    <table class="table table-required no-wrap v-middle mb-0">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Document
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Type
                                </th>
                                <th class="border-0"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="javascript:" data-toggle="modal" data-target="#document-modal">
            <div class="upload-box col-12 text-center text-muted p-4">
                <i data-feather="plus" style="height: 70px; width: 70px"></i>
                <h5>Click here to add document</h5>
            </div>
        </a>
    </div>
</div>

@push('scripts')
<script>
    var required_documents = JSON.parse(atob("{{ isset($required_documents) ? base64_encode($required_documents) : base64_encode('[]') }}")).map((item) => {
        return item.value;
    });
    function checkRequiredDocuments() {
        var exists = [];
        $('.document-type-val').each(function() {exists.push($(this).data('value'));});
        const result = required_documents.every(val => exists.includes(val));

        if (result) {
            $('.req-docs').removeClass('text-danger').addClass('text-dark');
            $('#required-documents-error').addClass('d-none');
        } else {
            $('.req-docs').removeClass('text-dark').addClass('text-danger');
            $('#required-documents-error').removeClass('d-none');
        }

        return result;
    }

    function updateCountDocument() {
        var t_body = $("#document-table-container > table > tbody");
        var t_count = $(t_body).closest(".card-body").find('.t-count');
        var length = $(t_body).children().length;
        var table_length_text = length == 1 ? `${length} entry` : `${length} entries`;

        t_count.html(table_length_text);
    }

    function moveDocumentFromModalToTable() {
        var clonedObject = $.extend(true, {}, $('#document-file'));

        clonedObject.removeAttr('id').addClass('d-none table-input-file').attr('required', false);
        $('#document-table-container > table > tbody > tr').last().find('td').first().append(clonedObject);
    }

    function storeDocument() {
        var t_body = $("#document-table-container > table > tbody");
        var border_class = t_body.children().length == 0 ? "border-top-0" : "";

        t_body.append(`<tr>
                            <td class="d-none"><input type="checkbox" name="documents_meta[]"
                            value='${JSON.stringify({
                                filename: $('#document-file').prop('files')[0].name,
                                type: $('#document-type').val(),
                                custom_type: $('#document-custom-type').val(),
                            })}'
                            data-parsley-required="true
                            data-parsley-mincheck="1"
                            data-parsley-errors-container="#document-table-container"
                            data-parsley-error-message="At least one container must be selected" checked>
                            </td>
                            <td class="${border_class} py-4 text-muted"><i data-feather="file-text"></i></td>
                            <td class="${border_class} py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16">${$('#document-file').prop('files')[0].name}</h5>
                                    </div>
                                </div>
                            </td>
                            <td class="${border_class} py-4">
                                <div class="d-flex no-block align-items-center">
                                    <div class="">
                                        <h5 class="text-dark mb-0 font-16 font-weight-medium document-type-val" data-value="${$('#document-type').val()}">${$('#document-type').val()}</h5>
                                        <span class="text-muted font-14">${$('#document-custom-type').val()}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="${border_class} py-4">
                                <a href="javascript:" class="font-12 text-danger" onclick="deleteItem(this)"><i data-feather="x"></i></a>
                            </td>
                        </tr>`);
        moveDocumentFromModalToTable();
        checkRequiredDocuments();
        updateCountDocument();
        feather.replace();
    }
</script>
@endpush
