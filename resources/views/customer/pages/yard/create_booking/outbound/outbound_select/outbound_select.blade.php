<div class="row px-0 px-lg-3 font-14">
    <div class="col-md-5">
        <div class="bg-white p-3 mb-3 shadow-sm" style="border-radius: 8px">
            <div class="row m-0">
                <div class="col-12 m-0 p-0 align-self-center">
                    <table>
                        <tr>
                            <td>
                                <h5 class="mb-0 text-dark font-14">Job Type</h5>
                            </td>
                            <td>
                                <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium input-text job-type-text"></span></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="mb-0 text-dark font-14">Paid Thru Date</h5>
                            </td>
                            <td>
                                <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium input-text paid-thru-text"></span></h5>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="bg-white p-3 mb-3 shadow-sm bl-section" style="border-radius: 8px">
            <div class="row m-0">
                <div class="col-12 m-0 p-0 align-self-center">
                    <table>
                        <tr>
                            <td>
                                <h5 class="mb-0 text-dark font-14">B/L No.</h5>
                            </td>
                            <td>
                                <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium input-text bl-no-text"></span></h5>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h5 class="mb-0 text-dark font-14">B/L Date</h5>
                            </td>
                            <td>
                                <h5 class="mb-0 text-dark font-14">: <span class="font-weight-medium input-text bl-date-text"></span></h5>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="bg-white p-3 mb-3 shadow shadow-sm bl-section" style="border-radius: 8px">
            <div class="row m-0">
                <div class="col-12 m-0 p-0 align-self-center">
                    <div class="row">
                        <div class="col-10 align-items-center">
                            <h5 class="text-dark font-14 font-weight-medium">Release Document</h5>
                        </div>
                        <div class="col-2 align-items-center">
                            <div class="text-center" id="document-icon-container">
                            </div>
                        </div>
                    </div>
                    <div class="collapse doc-collapse row" id="document-summary-collapse">
                        <div class="col-12">
                            <h5 class="mb-0 mt-2 text-secondary font-14">SPPB No.</h5>
                            <h5 class="text-dark font-weight-medium input-text sppb-no-text">476718/KPU.01/2020</h5>
                        </div>
                        <div class="col-12">
                            <h5 class="mb-0 text-secondary font-14">PIB No.</h5>
                            <h5 class="text-dark font-weight-medium input-text pib-no-text">476236</h5>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <a href="#document-detail-collapse" class="collapsed" data-toggle="collapse" aria-controls="document-detail-collapse">
                                <div class="collapse-arrow">
                                    Detail <i class="icon text-secondary text-center" data-feather="chevron-down"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="collapse doc-collapse row" id="document-failed-collapse">
                        <div class="col-12 text-center">
                            <div class="my-3 mx-4">
                                <h1 class="text-danger"><i class="fas fa-times-circle"></i></h1>
                                <h5 class="text-dark font-14">Failed to fetch documents data related to B/L.
                                    Please make sure B/L No. is correct, documents are registered, and try again.</h5>
                            </div>
                            <div class="mb-3">
                                <a href="javascript:" onclick="fetchBLSPPBDocumentFromInput()">Retry Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse doc-collapse col-12 m-0 p-0" id="document-detail-collapse">
                    <table>
                    </table>
                </div>
            </div>
        </div>
        <div class="shadow-sm bg-white mb-3 container-section" style="border: 1px dashed #ddd;border-radius: 8px" id="add-new-staff-container">
            <div class="px-4 py-3 align-self-center">
                <a href="#add-container-to-order" class="collapsed"data-toggle="collapse" aria-controls="add-container-to-order">
                    <div class="row align-items-center">
                        <div class="col-10 col-md-11">
                            <h5 class="mb-0 text-dark font-weight-medium" id="quotation-title">Input Additional Container</h5>
                        </div>
                        <div class="col-2 col-md-1 text-center collapse-arrow">
                            <i class="icon text-secondary" data-feather="chevron-down"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="collapse col-12 px-3" id="add-container-to-order">
                <div class="row px-3">
                    @foreach ($search_additional_container_fields as $field)
                        @include('layouts.input_form')
                    @endforeach
                    <div class="col-12 d-flex mb-4 justify-content-center">
                        <button type="button" class="btn btn-outline-primary" onclick="fetchContainerData(this)">+ Add Container to Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <form id="container_list_form" action="" method="post">
            <h6 class="text-dark mb-0">Container List<span class='text-danger'>*</span></h6>
            <div class="text-secondary font-italic font-12 mb-2 input-text" id="container-list-note"></div>
            <div class="shadow bg-white" style="max-height: 425px; overflow: auto; border-radius: 8px;">
                <div class="table-responsive" id="container-list-table-container">
                    <table class="table table-required no-wrap v-middle mb-0">
                        <thead>
                            <tr class="border-0">
                                <th class="border-0"></th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Container
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Yard
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Gate In Date
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Status
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Shipping Info
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex mt-5 justify-content-center">
                <button type="button" class="btn btn-primary step2-btn" onclick="finalizeOrder()" disabled>Calculate Price and Finalize Order</button>
            </div>
            <div class="d-flex mt-2 justify-content-center">
                <button type="button" class="btn btn-outline-danger border-0" onclick="resetButton()">Reset</button>
            </div>
        </form>
    </div>
</div>

@include('customer.pages.yard.create_booking.outbound.outbound_select.js_outbound_select')
