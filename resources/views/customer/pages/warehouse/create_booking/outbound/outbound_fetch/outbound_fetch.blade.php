<div class="row px-0 px-lg-3 w-100 font-14">
    <div class="col-md-5">
        <form action="" method="POST" id="form_cargo">
            @csrf
            <div class="bg-light p-3 mb-5 shadow shadow-sm" style="border-radius: 8px">
                <div class="row m-0">
                    <div class="col-12 m-0 p-0 align-self-center">
                        <h5 class="mb-0 text-dark text-center font-14">For <span class="font-weight-medium">Domestic / Import</span> type</h5>
                    </div>
                </div>
            </div>
            <div class="card my-4 shadow">
                <div class="card-body">
                    <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                        <div class="row m-0">
                            <div class="col-12 m-0 p-0 align-self-center">
                                <h5 class="mb-0 text-white text-center">Input Type</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        @foreach ($input_cargo_date_fields as $field)
                            @include('layouts.input_form')
                        @endforeach
                        <div class="col-12 d-flex mb-2 justify-content-center">
                            <button type="button" id="form-cargo-btn" onclick="fetchCargo()" class="btn step1-btn btn-outline-primary">+ Choose Cargo</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-2 d-flex align-items-center justify-content-center">
        <div class="vertical-divider-text text-center text-muted font-12 font-weight-medium mb-4 mb-md-0">OR</div>
    </div>
    <div class="col-md-5">
        <form action="" method="POST" id="form_container">
            @csrf
            {{-- TODO: Change API --}}
            <input type="hidden" name="api" value="fetchYardContainerService">

            <div class="bg-light p-3 mb-5 shadow shadow-sm" style="border-radius: 8px">
                <div class="row m-0">
                    <div class="col-12 m-0 p-0 align-self-center">
                        <h5 class="mb-0 text-dark text-center font-14">For <span class="font-weight-medium">Export</span> type</h5>
                    </div>
                </div>
            </div>
            <div class="card my-4 shadow">
                <div class="card-body">
                    <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                        <div class="row m-0">
                            <div class="col-12 m-0 p-0 align-self-center">
                                <h5 class="mb-0 text-white text-center">Input Container</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        @foreach ($input_container_fields as $field)
                            @include('layouts.input_form')
                        @endforeach
                        <div class="col-12 d-flex mb-2 justify-content-center">
                            <button type="button" id="form-container-btn" onclick="fetchContainer()" class="btn step1-btn btn-outline-primary">+ Choose Container</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('customer.pages.warehouse.create_booking.outbound.outbound_fetch.js_outbound_fetch')
