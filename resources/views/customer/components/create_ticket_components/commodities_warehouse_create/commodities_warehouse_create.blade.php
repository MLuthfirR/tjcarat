<div class="row px-0 px-lg-3">
    <div class="col-lg-5">
        <div class="card my-4 shadow">
            <div class="card-body">
                <div class="bg-secondary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                    <div class="row m-0">
                        <div class="col-12 m-0 p-0 align-self-center">
                            <h5 class="mb-0 text-white text-center">Input Commodity</h5>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    @foreach ($commodity_fields as $field)
                        @include('layouts.input_form')
                    @endforeach
                    <div class="col-12 mb-2">
                        <small>Every item added will be put into the "<span class="font-italic">Commodities List</span>" as part of the order's details.</small>
                    </div>
                    <div class="col-md-8 mb-2">
                        <button type="button" class="btn btn-outline-primary btn-block" onclick="storeCommodity(this)">
                            + Add Commodity
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
                    <h4 class="card-title">Commodities List<?php ($required) ? print("<span class='text-danger'>*</span>") : '' ?></h4>
                    <div class="ml-auto mr-3 pr-3">
                        <p class="font-14 text-muted pb-1 m-0 t-count" id="table-count">0 entries</p>
                        @if ($required)
                            <input class="d-none t-count-int" type="number" min="1" value="0"
                                data-parsley-error-message="Table should not be empty"
                                data-parsley-errors-container="#item-table-container"
                                data-parsley-group="main">
                        @endif
                    </div>
                </div>
                <div class="table-responsive" id="item-table-container">
                    <table class="table table-required no-wrap v-middle mb-0">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Commodity
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Qty
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Detail Description</th>
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
    function getVolumeData() {
        var temp_volume = $('#temp_volume').val();
        var temp_volume_unit = $('#temp_volume_unit').val();
        var volume = {};

        if (temp_volume && temp_volume != '') {
            volume['val'] = temp_volume;
            volume['unit'] = (temp_volume_unit && temp_volume_unit != '') ? temp_volume_unit : 'm3';
        }

        return volume;
    }

    function getWeightData() {
        var temp_weight = $('#temp_weight').val();
        var temp_weight_unit = $('#temp_weight_unit').val();
        var weight = {};

        if (temp_weight && temp_weight != '') {
            weight['val'] = temp_weight;
            weight['unit'] = (temp_weight_unit && temp_weight_unit != '') ? temp_weight_unit : 'kgm';
        }

        return weight;
    }

    function updateCommoditiesCount() {
        var t_body = $("#item-table-container > table > tbody");
        var t_count = $(t_body).closest(".card-body").find('.t-count');
        var t_count_int = $(t_body).closest(".card-body").find('.t-count-int');
        var length = $(t_body).children().length
        var table_length = length == 1 ? `${length} entry` : `${length} entries`;

        t_count_int.val(length);
        t_count.html(table_length);
    }

    function emptyFields() {
        $('#temp_house_bl').val('');
        $('#temp_commodity').val('');
        $('#temp_category').val('').trigger('change');
        $('#temp_qty').val('');
        $('#temp_unit').val('');
        $('#temp_detail').val('');
        $('#temp_volume').val('');
        $('#temp_volume_unit').val('');
        $('#temp_weight').val('');
        $('#temp_weight_unit').val('').trigger('change');
    }

    function storeCommodity(elmt) {
        $(elmt).closest('form').parsley().validate({group: "t-input-commodity"});
        if ($(elmt).closest('form').parsley().isValid({group: "t-input-commodity"})) {

            var t_body = $("#item-table-container > table > tbody");
            var border_class = t_body.children().length == 0 ? "border-top-0" : "";

            var volume = getVolumeData();
            var weight = getWeightData();

            t_body.append(`<tr>
                                <td class="d-none"><input type="checkbox" name="commodities[]"
                                value='${JSON.stringify({
                                    house_bl: $('#temp_house_bl').val(),
                                    commodity: $('#temp_commodity').val(),
                                    category: $('#temp_category').val(),
                                    qty: $('#temp_qty').val(),
                                    unit: $('#temp_unit').val(),
                                    volume: volume['val'] || null,
                                    volume_unit: volume['unit'] || null,
                                    weight: weight['val'] || null,
                                    weight_unit: weight['unit'] || null,
                                    description: $('#temp_detail').val(),
                                })}'
                                data-parsley-required="true
                                data-parsley-mincheck="1"
                                data-parsley-errors-container="#item-table-container"
                                data-parsley-error-message="At least one container must be selected" checked>
                                </td>
                                <td class="${border_class} py-4 text-muted"><i data-feather="package"></i></td>
                                <td class="${border_class} py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_commodity').val()}</h5>
                                            <h5 class="text-dark mb-0 font-14 font-weight-medium">House BL: ${$('#temp_house_bl').val()}</h5>
                                            <p class="text-muted font-12 mb-0">Category: <span>${$('#temp_category').val()}</span></p>
                                            <p class="text-muted font-12 mb-0">Volume: <span>${volume['val'] || '-'} ${volume['unit'] || ''}</span></p>
                                            <p class="text-muted font-12 mb-0">Weight: <span>${weight['val'] || '-'} ${weight['unit'] || ''}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="${border_class} py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_qty').val()} <span class="text-muted font-14">${$('#temp_unit').val()}</span></h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="${border_class} py-4">
                                    <p class="m-0 p-0 overflow-auto text-wrap text-muted font-14" style="width: 150px; max-height: 70px">
                                        ${$('#temp_detail').val()}
                                    </p>
                                </td>
                                <td class="${border_class} py-4">
                                    <a href="javascript:" class="font-12 text-danger" onclick="deleteItem(this)"><i data-feather="x"></i></a>
                                </td>
                            </tr>`);
            emptyFields();
            updateCommoditiesCount();
            $(elmt).closest('form').parsley().reset();
            feather.replace();
        }
    }
</script>
@endpush
