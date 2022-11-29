@extends('pages.auth.main_wrapper')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
        <div class="auth-box row">
            <div class="col-lg-12 col-md-7 bg-white">
                <div class="p-3">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo_bll.png') }}" style="width: 100px" alt="wrapkit">
                    </div>
                    <h2 class="mt-3 text-center font-weight-medium">Sign Up</h2>
                    <p class="text-center">Welcome to CARAT STS Integrated System!</p>
                    <form action="" id="form_createorder" method="POST" enctype="multipart/form-data" class="mt-4">
                        {{ csrf_field() }}
                        @include('components.alert')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="company_name">Company Name</label>
                                    <input class="form-control" id="company_name" name="company_name" type="text" value="{{ old('company_name') }}"
                                        placeholder="Enter your company_name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="text" value="{{ old('email') }}"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="company_phone_number">Company Phone No.</label>
                                    <input class="form-control" id="company_phone_number" name="company_phone_number" type="tel" value="{{ old('company_phone_number') }}"
                                        placeholder="Enter your phone number" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="company_address">Company Address</label>
                                    <input class="form-control" id="company_address" name="company_address" type="text" value="{{ old('company_address') }}"
                                        placeholder="Enter your company name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="npwp">NPWP</label>
                                    <input class="form-control" id="npwp" name="npwp" type="text" value="{{ old('npwp') }}"
                                        placeholder="Enter your NPWP"
                                        pattern="[0-9]{2}\.[0-9]{3}\.[0-9]{3}\.[0-9]-[0-9]{3}\.[0-9]{3}"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pic_name">PIC Name</label>
                                    <input class="form-control" id="pic_name" name="pic_name" type="text" value="{{ old('pic_name') }}"
                                        placeholder="Enter your company name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="pic_title">PIC Title</label>
                                    <input class="form-control" id="pic_title" name="pic_title" type="text" value="{{ old('pic_title') }}"
                                        placeholder="Enter your company name" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        autocomplete="on" placeholder="Enter your password" required>
                                    <p class="font-12 mb-0 ml-1">Password must be at least 8 letters and consists of:</p>
                                    <p class="font-12 mb-0 ml-1">- Lowercase letter (a-z)</p>
                                    <p class="font-12 mb-0 ml-1">- Uppercase letter (A-Z)</p>
                                    <p class="font-12 mb-0 ml-1">- Digit (0-9)</p>
                                    <p class="font-12 mb-0 ml-1">- Special character (@, $, !, %, *, #, ?, &)</p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="password_confirmation">Password Confirmation</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password"
                                        placeholder="Enter your password" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="npwp">Document</label>
                                    @include('customer.components.create_ticket_components.documents_create.documents_create')
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" id="submit-form" onclick="storeOrder()" class="btn btn-block btn-dark">Sign Up</button>
                            </div>
                            <div class="col-lg-12 text-center mt-5">
                                Already have an account? <a href={{ route('login') }} class="text-danger">Sign In</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.modals.document_uploader.document_uploader_modal')
    @include('components.modals.success.success_modal')
@endsection
@include('customer.pages.forwarding.create_ticket.js_create_ticket')
@push('scripts')
    <script src="{{ asset('assets/extra-libs/jquery-inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        $('#npwp').inputmask({"mask": "99.999.999.9-999.999"});</script>
@endpush
