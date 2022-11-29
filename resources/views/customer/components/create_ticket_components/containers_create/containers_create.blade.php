
<div class="row px-0 px-lg-3">
    <div class="col-lg-5">
        <div class="card my-4 shadow">
            <div class="card-body">
                <div class="bg-secondary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                    <div class="row m-0">
                        <div class="col-12 m-0 p-0 align-self-center">
                            <h5 class="mb-0 text-white text-center">Input Containers</h5>
                        </div>
                    </div>
                </div>
                <div class="row px-3">
                    @foreach ($container_fields as $field)
                        @include('layouts.input_form')
                    @endforeach
                    <div class="col-12 mb-2">
                        <small>Every container added will be put into the "<span class="font-italic">Containers List</span>" as part of the booking order's details.</small>
                    </div>
                    <div class="col-md-8 mb-2">
                        <button type="button" class="btn btn-outline-primary btn-block" onclick="storeContainer(this)">
                            + Add Container
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
                    <h4 class="card-title">Containers List<?php ($required) ? print("<span class='text-danger'>*</span>") : '' ?></h4>
                    <div class="ml-auto mr-3 pr-3">
                        <p class="t-count font-14 text-muted pb-1 m-0" id="table-count-container">0 entries</p>
                        @if ($required)
                            <input class="d-none t-count-int" type="number" min="1" value="0"
                                data-parsley-error-message="Table should not be empty"
                                data-parsley-errors-container="#item-table-container"
                                data-parsley-group="main">
                        @endif
                    </div>
                </div>
                <div class="table-responsive" id="container-table-container">
                    <table class="table no-wrap v-middle mb-0">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Container
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Size/Type</th>
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
    function updateContainersCount() {
        var t_body = $("#container-table-container > table > tbody");
        var t_count = $(t_body).closest(".card-body").find('.t-count');
        var t_count_int = $(t_body).closest(".card-body").find('.t-count-int');
        var length = $(t_body).children().length
        var table_length = length == 1 ? `${length} entry` : `${length} entries`;

        t_count_int.val(length);
        t_count.html(table_length);
    }

    function emptyFields() {
        $('#temp_container_number').val('');
        $('#temp_container_type').val('').trigger('change');
        $('#temp_container_size').val('').trigger('change');
        $('#temp_container_status').val('').trigger('change');
    }

    function storeContainer(elmt) {
        $(elmt).closest('form').parsley().validate({group: "t-input-containers"});
        if ($(elmt).closest('form').parsley().isValid({group: "t-input-containers"})) {

            var t_body = $("#container-table-container > table > tbody");
            var border_class = t_body.children().length == 0 ? "border-top-0" : "";

            t_body.append(`<tr>
                        <td class="d-none"><input type="checkbox" name="containers[]"
                        value='${JSON.stringify({
                            container_number: $('#temp_container_number').val(),
                            container_type: $('#temp_container_type').val(),
                            container_size: $('#temp_container_size').val(),
                            status: $('#temp_container_status').val(),
                        })}'
                        data-parsley-required="true
                        data-parsley-mincheck="1"
                        data-parsley-errors-container="#container-table-container"
                        data-parsley-error-message="At least one container must be selected" checked>
                        </td>
                        <td class="${border_class} py-4 text-muted"><i data-feather="package"></i></td>
                        <td class="${border_class} py-4">
                            <div class="d-flex no-block align-items-center">
                                <div class="">
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_container_number').val()}</h5>
                                    <p class="text-muted font-14 m-0">Status: ${$('#temp_container_status').val()}</p>
                                </div>
                            </div>
                        </td>
                        <td class="${border_class} py-4">
                            <div class="d-flex no-block align-items-center">
                                <div class="">
                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">${$('#temp_container_size').val()}</h5>
                                    <p class="text-muted font-14 m-0">${$('#temp_container_type').val()}</p>
                                </div>
                            </div>
                        </td>
                        <td class="${border_class} py-4">
                            <a href="javascript:" class="font-12 text-danger" onclick="deleteItem(this)"><i data-feather="x"></i></a>
                        </td>
                    </tr>`);
            emptyFields();
            updateContainersCount();
            $(elmt).closest('form').parsley().reset();
            feather.replace();
        }
    }
</script>
@endpush
