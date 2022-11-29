@extends('layouts.sidebar')

@section('sidebar-list')
    {{-- <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('sa.dashboard') }}"
        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
            class="hide-menu">Dashboard</span></a></li> --}}

    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Users</span></li>
    {{-- <li class="sidebar-item"> <a class="sidebar-link" href="{{ route('sa.users.staff') }}"
        aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span
            class="hide-menu">Staff Management</span></a>
    </li> --}}
    <li class="sidebar-item"> <a class="sidebar-link" href="#"
        aria-expanded="false"><i data-feather="user-check" class="feather-icon"></i><span
            class="hide-menu">Customer & Approval</span></a>
        </li>
@endsection
