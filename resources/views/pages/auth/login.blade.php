@extends('pages.auth.main_wrapper')

@section('content')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
        <div class="auth-box row">
            <div class="col-lg-7 col-md-5 modal-bg-img p-0">
                <video class="video-fluid w-100 h-100 video-banner" autoplay="yes" loop="yes" muted="yes" preload="" style="object-fit: cover">
                    <source src="{{ asset('assets/videos/port.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="col-lg-5 col-md-7 bg-white">
                <div class="p-3">
                    <div class="text-center">
                        <img src="{{ asset('assets/images/logo_bll.png') }}" style="width: 150px" alt="wrapkit">
                    </div>
                    <h2 class="mt-3 text-center font-weight-medium">Sign In</h2>
                    <p class="text-center">Enter your email address and password to access Tanjung Carat STS Integrated System.</p>
                    <form action="{{ route('login.store') }}" method="post" class="mt-4">
                        @csrf
                        @include('components.alert')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-dark" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        autocomplete="on" placeholder="Enter your password" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                            </div>
                            <div class="col-lg-12 text-center mt-5">
                                Don't have an account?
                            </div>
                            <div class="col-lg-12 text-center mt-1">
                                <a href="{{ route('register') }}" target="_blank" class="btn btn-outline-success">
                                    <p class="m-0">Sign Up</p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
