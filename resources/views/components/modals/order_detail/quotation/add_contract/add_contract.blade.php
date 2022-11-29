<div class="p-3 shadow-sm" style="border: 1px dashed #6c757d; border-radius: 8px">
    <a href="#add-new-contract-collapse" class="collapsed" data-toggle="collapse" aria-controls="add-new-contract-collapse">
        <div class="row align-items-center">
            <div class="col-10">
                <h5 class="font-14 font-weight-medium text-dark mb-0">+ Add New Contract</h5>
            </div>
            <div class="col-2 collapse-arrow">
                <i class="icon text-secondary" data-feather="chevron-down"></i>
            </div>
        </div>
    </a>
    <div class="collapse" id="add-new-contract-collapse">
        <div class="mt-3">
            <div class="row mb-2">
                <div id="contract-etc-container" class="col-12">
                    <div class="spinner-border text-white text-center" role="status"></div>
                </div>
                <div id="contract-container" class="col-12 d-none">
                    <select class="form-control select2 custom-select"
                        style="width: 100%"
                        id="contract_type"
                        data-parsley-group="quotation-contract-add-fields"
                        required>
                    <option disabled selected value="">Choose contract service</option>
                    </select>
                </div>
            </div>
            <div class="row px-3 pt-2 pb-3 collapse" id="contract-data-container">

            </div>
            <div class="row" id="contract_input_qty_container">
                <div class="col-md-5 mb-2">
                    <input id="contract_input_qty" type="number"
                    style="width: 100%"
                    class="form-control contract_qty_price_input"
                    placeholder="Qty"
                    min=1
                    data-parsley-group="quotation-contract-add-fields"
                    data-parsley-errors-container="#contract_input_qty_container"
                    required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <h5 class="mb-0 font-14 text-dark">Est. Price Rp<span id="input_contract_est_price" class="font-weight-medium">0,00</span></h5>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <button type="button" class="btn btn-outline-success" onclick="storeQuotationContractItem()">Add Contract Service</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modals.order_detail.quotation.add_contract.js_add_contract')
