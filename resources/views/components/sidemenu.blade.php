<aside id="layout-menu" class="layout-menu menu-vertical menu">

    <div class="app-brand demo ">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img/logo/logo-sis.png') }}" class="img-fluid" alt="logo sis" width="40" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">SIS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base bx bx-chevron-left"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">
        <li class="menu-item {{ Request::is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class="menu-icon icon-base bx bx-home-smile"></i>
                <div>Dashboard</div>
            </a>
        </li>
        @if ($user->role->name === 'admin' || $user->department->initial === 'PPIC')
            <li class="menu-item {{ Request::is('planning*') ? 'active' : '' }}">
                <a href="/planning" class="menu-link">
                    <i class="menu-icon icon-base bx bx-calendar"></i>
                    <div>Planning</div>
                </a>
            </li>
        @endif
        <li class="menu-item {{ Request::is('workshop*') ? 'active' : '' }}">
            <a href="/workshop" class="menu-link">
                <i class="menu-icon icon-base bx bx-calendar-check"></i>
                <div>Workshop</div>
            </a>
        </li>
        @if ($user->role->name === 'admin')
            <li class="menu-header small">
                <span class="menu-header-text">Master Data</span>
            </li>
            <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
                <a href="/user" class="menu-link">
                    <i class="menu-icon icon-base bx bx-detail"></i>
                    <div>Data User</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('department*') ? 'active' : '' }}">
                <a href="/department" class="menu-link">
                    <i class="menu-icon icon-base bx bx-detail"></i>
                    <div>Data Department</div>
                </a>
            </li>
            {{-- <li class="menu-item {{ Request::is('client*') ? 'active' : '' }}">
                <a href="/client" class="menu-link">
                    <i class="menu-icon icon-base bx bx-detail"></i>
                    <div>Data Client</div>
                </a>
            </li> --}}
            <li class="menu-header small">
                <span class="menu-header-text">Log Data</span>
            </li>
            <li class="menu-item {{ Request::is('log*') ? 'active' : '' }}">
                <a href="/log" class="menu-link">
                    <i class="menu-icon icon-base bx bx-detail"></i>
                    <div>Log</div>
                </a>
            </li>
        @endif

    </ul>


</aside>
<div class="menu-mobile-toggler d-xl-none rounded-1">
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
        <i class="bx bx-menu icon-base"></i>
        <i class="bx bx-chevron-right icon-base"></i>
    </a>
</div>
