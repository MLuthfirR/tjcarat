<div class="modal fade" id="document-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body px-4 px-lg-5">
                <form id="form_document" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="card shadow">
                            <div class="card-body mt-2">
                                <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                                    <div class="row m-0">
                                        <div class="col-12 m-0 p-0 align-self-center">
                                            <h5 class="mb-0 text-white text-center">Document Upload</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3">
                                    <div class="col-12">
                                        <div class="form-group has-feedback">
                                            <h6 class="text-dark mb-2">Document<span class='text-danger'>*</span></h6>
                                            <div class="input-group" id="document-file-container">
                                                <input type="file" class="custom-file-input" id="document-file" aria-labelledby="document-file-label"
                                                        data-parsley-group="document_input"
                                                        data-parsley-errors-container="#document-file-container" required>
                                                <label class="custom-file-label font-14" id="document-file-label">Choose file...</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-feedback">
                                            <h6 class="text-dark mb-2">Document Type<span class='text-danger'>*</span></h6>
                                            <select class="form-control select2 custom-select"
                                                style="width: 100%"
                                                id="document-type"
                                                data-parsley-group="document_input"
                                                required>
                                            <option disabled selected value="-1">Choose document type...</option>
                                            @if (isset($document_types))
                                                @foreach ($document_types as $document_type)
                                                    <option value="{{ $document_type['value'] }}">{{ $document_type['text'] }}</option>
                                                @endforeach
                                            @endif
                                            <option value="Custom">Others</option>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group has-feedback">
                                            <h6 class="text-dark mb-2">Custom Type</h6>
                                            <input type="text" class="form-control" id="document-custom-type"
                                                    placeholder="Example: Pre-invoice"
                                                    data-parsley-group="document_input" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 offset-1 mb-2">
                            <button type="button" id="document-add-button" class="btn btn-outline-primary btn-block">
                                + Add Document
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('components.modals.document_uploader.js_document_uploader_modal')
