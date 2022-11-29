@extends('layouts.navbar')

@section('navbar-logo')
    <!-- Logo icon -->
    <a href="{{ route('admin.dashboard') }}">
        <b class="logo-icon">
            <!-- Dark Logo icon -->
            <img src="{{ asset('assets/images/logo_bll.png') }}" alt="homepage" class="dark-logo" style="width: 45px"/>
            <!-- Light Logo icon -->
            <img src="{{ asset('assets/images/logo_bll.png') }}" alt="homepage" class="light-logo" style="width: 45px"/>
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="logo-text">
            <!-- dark Logo text -->
            <img src="{{ asset('assets/images/logo_bll.png') }}" alt="homepage" class="dark-logo" style="width: 100px"/>
            <!-- Light Logo text -->
            <img src="{{ asset('assets/images/logo_bll.png') }}" alt="homepage" class="light-logo" style="width: 100px"/>
        </span>
    </a>
@endsection

@section('navbar-text')
    <h5 class="m-0 p-0 mb-0 text-muted">Admin</h5>
@endsection

@section('navbar-options')
    <a class="dropdown-item" href="#"><i data-feather="user"
        class="svg-icon mr-2 ml-1"></i>
    My Profile</a>
@endsection
