<div class="p-3 shadow-sm" style="border: 1px dashed #6c757d; border-radius: 8px">
    <a href="#add-new-service-collapse" class="collapsed" data-toggle="collapse" aria-controls="add-new-service-collapse">
        <div class="row align-items-center">
            <div class="col-10">
                <h5 class="font-14 font-weight-medium text-dark mb-0">+ Add New Service</h5>
            </div>
            <div class="col-2 collapse-arrow">
                <i class="icon text-secondary" data-feather="chevron-down"></i>
            </div>
        </div>
    </a>
    <div class="collapse" id="add-new-service-collapse">
        <div class="mt-3">
            <div class="row mb-2">
                <div id="services-etc-container" class="col-12">
                    <div class="spinner-border text-white text-center" role="status"></div>
                </div>
                <div id="services-container" class="col-12 d-none">
                    <select class="form-control select2 custom-select"
                        style="width: 100%"
                        id="service_type"
                        data-parsley-group="quotation-add-fields"
                        required>
                    <option disabled selected value="">Choose service</option>
                    </select>
                </div>
            </div>
            <div class="row" id="input_qty_basedon_container">
                <div class="col-md-5 mb-2">
                    <input id="qty" type="number"
                    style="width: 100%"
                    class="form-control qty_price_input"
                    placeholder="Qty"
                    min=1
                    data-parsley-group="quotation-add-fields"
                    data-parsley-errors-container="#input_qty_basedon_container"
                    required>
                </div>
                <div id="basedon-etc-container" class="col-md-7 mb-2">
                    <div class="spinner-border text-white text-center" role="status"></div>
                </div>
                <div id="basedon-container" class="col-md-7 mb-2 d-none">
                    <select class="form-control select2 custom-select"
                        style="width: 100%"
                        id="based_on"
                        data-parsley-group="quotation-add-fields"
                        required>
                    <option disabled selected value="">Choose based on</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <input id="unit_price" type="number"
                    style="width: 100%"
                    class="form-control qty_price_input"
                    placeholder="Unit Price (Rp)"
                    min=0
                    data-parsley-group="quotation-add-fields"
                    required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <textarea class="form-control" rows="3" id="description" placeholder="Description" required></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h5 class="mb-0 font-14 text-dark">Est. Price Rp<span id="input_est_price" class="font-weight-medium">0,00</span></h5>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <button type="button" class="btn btn-outline-success" onclick="storeNewSevice()">Add Service</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.order_detail.quotation.add_service.js_add_service')
