@extends('layouts.navbar')

@section('navbar-logo')
    <!-- Logo icon -->
    <a href="{{ route('home') }}">
        <b class="logo-icon">
            <!-- Dark Logo icon -->
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" style="width: 45px"/>
            <!-- Light Logo icon -->
            <img src="{{ asset('assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" style="width: 45px"/>
        </b>
        <!--End Logo icon -->
        <!-- Logo text -->
        <span class="logo-text">
            <!-- dark Logo text -->
            <img src="{{ asset('assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" style="width: 100px"/>
            <!-- Light Logo text -->
            <img src="{{ asset('assets/images/logo-light-text.png') }}" alt="homepage" class="light-logo" style="width: 100px"/>
        </span>
    </a>
@endsection

@section('navbar-text')
    <h5 class="m-0 p-0 mb-1 text-dark">{{ $user->company_name }} <span class="text-muted font-14">| CUST ID: <span class="text-secondary">{{ $user->customer_id ?: '-' }}</span></span></h5>
    <h6 class="m-0 p-0 text-muted">NPWP: <span class="text-secondary">{{ $user->npwp ?: '-' }}</span></h6>
@endsection

@section('navbar-options')
    <a class="dropdown-item" href="{{ route('user.my-profile') }}"><i data-feather="user"
        class="svg-icon mr-2 ml-1"></i>
    My Profile</a>
@endsection
