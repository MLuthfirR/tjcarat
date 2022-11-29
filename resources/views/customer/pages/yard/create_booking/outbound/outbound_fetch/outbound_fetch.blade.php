<div class="row px-0 px-lg-3 w-100 font-14">
    <div class="col-md-5">
        <form action="" method="POST" id="form_container">
            @csrf
            <input type="hidden" name="api" value="fetchYardContainerService">

            <div class="bg-light p-3 mb-5 shadow shadow-sm" style="border-radius: 8px">
                <div class="row m-0">
                    <div class="col-12 m-0 p-0 align-self-center">
                        <h5 class="mb-0 text-dark text-center font-14">For <span class="font-weight-medium">Domestic</span> type</h5>
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
                        @foreach ($search_container_fields as $field)
                            @include('layouts.input_form')
                        @endforeach
                        <div class="col-12 d-flex mb-2 justify-content-center">
                            <button type="button" id="form-container-btn" onclick="fetchContainer()" class="btn step1-btn btn-outline-primary">+ Add Container to Order</button>
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
        <form action="" method="POST" id="form_bl">
            @csrf
            <input type="hidden" name="api" value="fetchBLYardService">

            <div class="bg-light p-3 mb-5 shadow shadow-sm" style="border-radius: 8px">
                <div class="row m-0">
                    <div class="col-12 m-0 p-0 align-self-center">
                        <h5 class="mb-0 text-dark text-center font-14">For <span class="font-weight-medium">Import</span> type</h5>
                    </div>
                </div>
            </div>
            <div class="card my-4 shadow">
                <div class="card-body">
                    <div class="bg-primary p-3 mb-4 shadow shadow-sm" style="border-radius: 8px; margin-top: -48px">
                        <div class="row m-0">
                            <div class="col-12 m-0 p-0 align-self-center">
                                <h5 class="mb-0 text-white text-center">Input B/L No.</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row px-3">
                        @foreach ($search_bl_fields as $field)
                            @include('layouts.input_form')
                        @endforeach
                        <div class="col-12 d-flex mb-2 justify-content-center">
                            <button type="button" id="form-bl-btn" onclick="fetchBL()" class="btn step1-btn btn-outline-primary">+ Fetch Containers to Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <p class="mb-0 mt-0 mt-md-2 text-center font-14">or, go to <span><a href="{{ route('yard.sp2.print') }}">PRINT SP2</a></span> section to print your SP2.</p>
    </div>
</div>

@include('customer.pages.yard.create_booking.outbound.outbound_fetch.js_outbound_fetch')
