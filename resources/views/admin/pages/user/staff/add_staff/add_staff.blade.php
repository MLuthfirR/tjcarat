<div class="shadow-sm bg-white" style="border: 1px dashed #ddd;border-radius: 8px" id="add-new-staff-container">
    <div class="px-4 py-3 align-self-center">
        <a href="#add-new-staff-collapse" class="collapsed"data-toggle="collapse" aria-controls="add-new-staff-collapse">
            <div class="row align-items-center">
                <div class="col-10 col-md-11">
                    <h5 class="mb-0 text-dark font-weight-medium" id="quotation-title">Add New Staff</h5>
                </div>
                <div class="col-2 col-md-1 text-center collapse-arrow">
                    <i class="icon text-secondary" data-feather="chevron-down"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="collapse col-12 px-3" id="add-new-staff-collapse">
        <form id="form_fetch_staff" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="api" value="registerStaff">
            <div class="row px-2">
                <div class="col-sm-4 mb-3">
                    <p class="text-dark font-12 mb-2">Register new admin and/or management staff account.</p>
                </div>
                <div class="col-sm-8 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group has-feedback">
                                <h6 class="text-dark mb-2">Name<span class='text-danger'>*</span></h6>
                                <input id="no_contract" type="text"
                                name="name"
                                style="width: 100%"
                                class="form-control add-staff-input"
                                placeholder="Example: John Doe"
                                required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <h6 class="text-dark mb-2">Email<span class='text-danger'>*</span></h6>
                                <input id="email" type="email"
                                name="email"
                                style="width: 100%"
                                class="form-control add-staff-input"
                                placeholder="Example: johndoe@domain.com"
                                required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <h6 class="text-dark mb-2">Phone No.<span class='text-danger'>*</span></h6>
                                <input id="phone_number" type="tel"
                                name="phone_number"
                                style="width: 100%"
                                class="form-control add-staff-input"
                                placeholder="Example: 08123456789"
                                required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <h6 class="text-dark mb-2">Type<span class='text-danger'>*</span></h6>
                                <select class="form-control add-staff-input select2 custom-select"
                                                style="width: 100%"
                                                id="role"
                                                name="role"
                                                required>
                                    <option disabled selected value="">Choose type</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-feedback">
                                <h6 class="text-dark mb-2">Permissions<span class='text-danger'>*</span></h6>
                                <div id="permissions-etc-container">
                                    <div class="spinner-border text-secondary" role="status"></div>
                                </div>
                                <div class="d-none" id="permissions-checkboxes-container">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row px-2">
                <div class="col-lg-6 offset-lg-3 mb-4">
                    <button type="button" class="btn btn-primary btn-block" onclick="registerStaff(this)">
                        Register Staff
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('sa.pages.user.staff.add_staff.js_add_staff')
