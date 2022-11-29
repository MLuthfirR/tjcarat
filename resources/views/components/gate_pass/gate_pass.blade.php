<div class="row mb-4 mx-4 mx-lg-5 px-3 bg-light shadow shadow-sm d-none hidden-container" style="border-radius: 8px" id="gate-pass-container">
    <div class="col-12 px-4 py-3 align-self-center">
        <a href="#order-detail-gate-pass-collapse" class="collapsed"data-toggle="collapse" aria-controls="order-detail-gate-pass-collapse">
            <div class="row align-items-center modal-element">
                <div class="col-10 col-lg-11">
                    <h5 class="mb-0 text-dark font-weight-medium" id="gate-pass-title">Gate Pass</h5>
                </div>
                <div class="col-2 col-lg-1 collapse-arrow">
                    <i class="icon text-secondary" data-feather="chevron-down"></i>
                </div>
            </div>
            <div class="text-center modal-spinner">
                <div class="spinner-border text-dark" role="status"></div>
            </div>
        </a>
    </div>
    <div class="collapse col-12 px-3" id="order-detail-gate-pass-collapse">
        <form id="form_order_gate_pass" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="api" value="{{ 'requestGatePass' }}">
            <div class="row px-2">
                <div class="col-12 mb-3">
                    <p class="text-dark font-12 mb-2">List of containers and the corresponding gate passes.
                        Request a gate pass for a container if not released yet.
                    </p>
                </div>
                <div class="col-lg-5 mb-3">
                    <h5 class="text-dark font-14 font-weight-medium">Containers</h5>
                    <div id="container-gate-pass-container">
                    </div>
                </div>
                <div id="request-gate-pass-container" class="col-lg-7 mb-3">
                    <h5 class="text-dark font-14 font-weight-medium" id="request-gate-pass">Request Gate Pass</h5>
                    <div class="border border-secondary shadow-sm p-3" style="border-radius: 8px">
                        <div class="d-none" id="request-gate-pass-input-container">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <p class="mb-0 text-dark font-14">Selected Container</p>
                                    <div id="selected-container-gate-pass-label">
                                    </div>
                                    <input type="hidden" class="gate-pass-input" name="yard_container_order_uuid" id="gate-pass-container-uuid">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <p class="mb-0 text-dark font-14">Truck Police Number</p>
                                    <input type="text"
                                        name="police_number"
                                        style="width: 100%"
                                        class="form-control gate-pass-input"
                                        placeholder="Ex: B 1234 ABC"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <p class="mb-0 text-dark font-14">Driver</p>
                                    <input type="text"
                                        name="driver"
                                        style="width: 100%"
                                        class="form-control gate-pass-input"
                                        placeholder="Ex: Budi"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12">
                                    <p class="mb-0 text-dark font-14">Place of <span class="origin-destination-label">Origin</span></p>
                                    <input type="text"
                                        name="origin_destination"
                                        style="width: 100%"
                                        class="form-control gate-pass-input"
                                        placeholder="Ex: Gudang A, Jl. Asal No. 1"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 d-flex justify-content-center mt-2">
                                    <button type="button" class="btn btn-primary shadow" onclick="requestGatePass(this)">Request Gate Pass</button>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 text-center" id="request-gate-pass-empty-banner">
                            <h1 class="text-secondary"><i class="fas fa-info-circle"></i></h1>
                            <h5 class="text-dark font-14 font-weight-medium mb-0">No container selected</h5>
                            <h5 class="text-dark font-12">Please select a container to request gate pass</h5>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('components.gate_pass.js_gate_pass')
