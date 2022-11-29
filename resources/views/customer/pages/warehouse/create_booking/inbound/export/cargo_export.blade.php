<div class="row px-0 px-lg-3">
    <div class="col-lg-5">
        <div class="card my-4 shadow">
            <div class="card-body">
                <div class="bg-secondary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                    <div class="row m-0">
                        <div class="col-12 m-0 p-0 align-self-center">
                            <h5 class="mb-0 text-white text-center">Input Cargo</h5>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    @foreach ($cargo_warehouse as $field)
                        @include('layouts.input_form')
                    @endforeach
                    <div class="col-12 mb-2">
                        <small>Every item added will be put into the "<span class="font-italic">Cargo List</span>" as part of the order's details.</small>
                    </div>
                    <div class="col-md-8 mb-2">
                        <button type="button" class="btn btn-outline-primary btn-block" onclick="storeCargo(this)">
                            + Add Cargo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card shadow">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <h4 class="card-title">Cargo List<?php ($required) ? print("<span class='text-danger'>*</span>") : '' ?></h4>
                    <div class="ml-auto mr-3 pr-3">
                        <p class="font-14 text-muted pb-1 m-0 t-count">0 entries</p>
                        @if ($required)
                            <input class="d-none t-count-int" type="number" min="1" value="0"
                                data-parsley-error-message="List should not be empty"
                                data-parsley-errors-container="#cargo-table-container"
                                data-parsley-group="main">
                        @endif
                    </div>
                </div>
                <div class="table-responsive" id="cargo-table-container">
                    <table class="table table-required no-wrap v-middle mb-0">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Cargo
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Qty
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Cargo Description</th>
                                <th class="border-0"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function updateCargoCount() {
        var t_body = $("#cargo-table-container > table > tbody");
        var t_count = $(t_body).closest(".card-body").find('.t-count');
        var t_count_int = $(t_body).closest(".card-body").find('.t-count-int');
        var length = $(t_body).children().length
        var table_length = length == 1 ? `${length} entry` : `${length} entries`;

        t_count_int.val(length);
        t_count.html(table_length);
    }

    function emptyCargoFields() {
        $('#temp_category').val('').trigger('change');
        $('#temp_product').val('').trigger('change');
        $('#temp_cargo_type').val('').trigger('change');
        $('#temp_marking').val('');
        $('#temp_so_no').val('');
        $('#temp_npe_no').val('');
        $('#temp_po_no').val('');
        $('#temp_qty').val('');
        $('#temp_packing').val('').trigger('change');
        $('#temp_volume').val('');
        $('#temp_weight').val('');
        $('#temp_description').val('');
    }

    function storeCargo(elmt) {
        $(elmt).closest('form').parsley().validate({group: "t-input-commodity"});
        if ($(elmt).closest('form').parsley().isValid({group: "t-input-commodity"})) {

            var t_body = $("#cargo-table-container > table > tbody");
            var border_class = t_body.children().length == 0 ? "border-top-0" : "";

            t_body.append(`<tr>
                                <td class="d-none"><input type="checkbox" name="commodities[]"
                                value='${JSON.stringify({
                                    category: $('#temp_category').val(),
                                    product: $('#temp_product').val(),
                                    cargo_type: $('#temp_cargo_type').val(),
                                    marking: $('#temp_marking').val(),
                                    so_no: $('#temp_so_no').val(),
                                    npe_no: $('#temp_npe_no').val(),
                                    po_no: $('#temp_po_no').val(),
                                    qty: $('#temp_qty').val(),
                                    packing: $('#temp_packing').val(),
                                    volume: $('#temp_volume').val(),
                                    volume_unit: $('#temp_volume_unit').val(),
                                    weight: $('#temp_weight').val(),
                                    weight_unit: $('#temp_weight_unit').val(),
                                    description: $('#temp_description').val(),
                                })}'
                                data-parsley-required="true
                                data-parsley-mincheck="1"
                                data-parsley-errors-container="#cargo-table-container"
                                data-parsley-error-message="At least one cargo must be selected" checked>
                                </td>
                                <td class="${border_class} py-4 text-muted"><i data-feather="package"></i></td>
                                <td class="${border_class} py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_marking').val()}</h5>
                                            <p class="text-muted font-12 mb-0">Product: <span>${$('#temp_product').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">Category: <span>${$('#temp_category').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">SO No.: <span>${$('#temp_so_no').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">NPE No.: <span>${$('#temp_npe_no').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">PO No.: <span>${$('#temp_po_no').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">Volume: <span>${$('#temp_volume').val() || '-'} ${$('#temp_volume_unit').val() || ''}</span></p>
                                            <p class="text-muted font-12 mb-0">Weight: <span>${$('#temp_weight').val() || '-'} ${$('#temp_weight_unit').val() || ''}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="${border_class} py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_qty').val()}</h5>
                                            <p class="text-muted font-12 mb-0">Packing: <span>${$('#temp_packing').val()}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="${border_class} py-4">
                                    <p class="m-0 p-0 overflow-auto text-wrap text-muted font-14" style="width: 150px; max-height: 70px">
                                        ${$('#temp_description').val()}
                                    </p>
                                </td>
                                <td class="${border_class} py-4">
                                    <a href="javascript:" class="font-12 text-danger" onclick="deleteItem(this)"><i data-feather="x"></i></a>
                                </td>
                            </tr>`);
            emptyCargoFields();
            updateCargoCount();
            $(elmt).closest('form').parsley().reset();
            feather.replace();
        }
    }
</script>
@endpush
