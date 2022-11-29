@extends('layouts.sidebar')

@section('sidebar-list')
    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('home') }}"
        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
            class="hide-menu">Home</span></a></li>

    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">My Orders</span></li>

    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('orders') }}"
        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span
            class="hide-menu">My Orders</span></a></li>
    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('billing.index') }}"
    aria-expanded="false"><i data-feather="credit-card" class="feather-icon"></i><span
        class="hide-menu">My Billings</span></a></li>

    <li class="list-divider"></li>
    <li class="nav-small-cap"><span class="hide-menu">Services</span></li>

    @permission('forwarding order')
        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:"
            aria-expanded="false"><i data-feather="navigation" class="feather-icon"></i><span
                class="hide-menu">Forwarding</span></a>
            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                <li class="sidebar-item"><a href="{{ route('forwarding.index') }}" class="sidebar-link"><span
                        class="hide-menu"> Forwarding
                    </span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:"><span
                            class="hide-menu"> + Order Ticket
                        </span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('forwarding.order.createexport') }}" class="sidebar-link"><span
                                class="hide-menu"> Export
                            </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('forwarding.order.createimport') }}" class="sidebar-link"><span
                                    class="hide-menu"> Import
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('forwarding.order.createdomestic') }}" class="sidebar-link"><span
                                    class="hide-menu"> Domestic
                                </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    @endpermission
    {{-- @permission('warehouse order')
        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:"
                aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                    class="hide-menu">Warehouse</span></a>
            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                <li class="sidebar-item"><a href="{{ route('warehouse.index') }}" class="sidebar-link"><span
                        class="hide-menu"> Warehouse
                    </span></a>
                </li>
                <li class="sidebar-item"><a href="javascript:" class="sidebar-link has-arrow"><span
                            class="hide-menu"> + Booking Ticket
                        </span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('warehouse.booking.create.inbound.index') }}" class="sidebar-link"><span
                                class="hide-menu"> Inbound
                            </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('warehouse.booking.create.outbound') }}" class="sidebar-link"><span
                                    class="hide-menu"> Outbound
                                </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    @endpermission --}}
    @permission('yard order')
        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:"
                aria-expanded="false"><i data-feather="map" class="feather-icon"></i><span
                    class="hide-menu">Yard</span></a>
            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                <li class="sidebar-item"><a href="{{ route('yard.index') }}" class="sidebar-link"><span
                        class="hide-menu"> Yard
                    </span></a>
                </li>
                <li class="sidebar-item"><a href="{{ route('yard.sp2.print') }}" class="sidebar-link"><span
                        class="hide-menu"> Print SP2
                    </span></a>
                </li>
                <li class="sidebar-item"><a href="javascript:" class="sidebar-link has-arrow"><span
                            class="hide-menu"> + Booking Ticket
                        </span></a>
                    <ul aria-expanded="false" class="collapse second-level base-level-line">
                        <li class="sidebar-item"><a href="{{ route('yard.booking.create.inbound') }}" class="sidebar-link"><span
                                class="hide-menu"> Inbound
                            </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ route('yard.booking.create.outbound.main') }}" class="sidebar-link"><span
                                    class="hide-menu"> Outbound
                                </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    @endpermission
@endsection
