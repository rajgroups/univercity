<!-- sidebar @s -->

<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">

            <h3><a href="index" class="logo-link text-white">Jamath</a></h3>
            {{-- <a href="#" class="logo-link nk-sidebar-logo">Jamath --}}
                {{-- <img class="logo-light logo-img" src="{{ asset('assets/images/logo/logo.jpg') }}"
                    srcset="{{ asset('assets/images/logo/logo.jpg') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('resource/web/img/logo/logo-white.png') }}"
                    srcset="{{ asset('resource/web/img/logo/logo-white.png') }} 2x" alt="logo-dark"> --}}
            {{-- </a> --}}
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
            <ul class="nk-menu">
    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Dashboards</h6>
    </li>
    <!-- Dashboard -->
    <li class="nk-menu-item">
        <a href="/admin/dashboard" class="nk-menu-link">
            <span class="nk-menu-icon"><i class="fa fa-tachometer"></i></span>
            <span class="nk-menu-text">Dashboard</span>
        </a>

    </li>


    {{-- product Management --}}

    <li class="nk-menu-item has-sub">
        <a href="#" class="nk-menu-link nk-menu-toggle">
            <span class="nk-menu-icon"><i class="icon ni ni-growth-fill"></i></span>
            <span class="nk-menu-text">Customer Management</span>
        </a>
        <ul class="nk-menu-sub">
            <li class="nk-menu-item"><a href="{{ route('admin.customers.create') }}" class="nk-menu-link"><span class="nk-menu-text">Customer Add</span></a></li>
            <li class="nk-menu-item"><a href="{{ route('admin.customers.index') }}" class="nk-menu-link"><span class="nk-menu-text">Customer List</span></a></li>
        </ul>
    </li>

    <!-- Logout -->
    <li class="nk-menu-item">
        <form id="logout-form-second" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-second').submit();" class="nk-menu-link">
            <span class="nk-menu-icon"><i class="fa fa-sign-out"></i></span>
            <span class="nk-menu-text">Logout</span>
        </a>
    </li>
</ul>


            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
<!-- sidebar @e -->
