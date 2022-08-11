{{-- <div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span style="color: #01C853; font-size:14px;">ADMIN DASHBOARD</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                <div class="pull-left">
                    <span class="right-nav-text">Analisis Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <li>
            <a class="nav-link {{ Request::is('scan-tamu') ? 'active' : '' }}" href="/scan-tamu">
                <div class="pull-left">
                    <span class="right-nav-text">Scan Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="pull-left">
                    <span class="right-nav-text">Daftar Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="pull-left">
                    <span class="right-nav-text">Daftar Admin</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="pull-left">
                    <span class="right-nav-text">Invoice</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <li class="navigation-header">
            <span style="color: #01C853; font-size:14px;">KATALOG</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="#">das
                <div class="pull-left">
                    <span class="right-nav-text">Package Item</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
</div> --}}

<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left mt-40">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>ADMIN DASHBOARD</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" data-toggle="collapse"
                data-target="#dashboard_dr">
                <div class="pull-left">
                    {{-- <i class="zmdi zmdi-landscape mr-20"></i> --}}
                    <span class="right-nav-text">Analisis Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('scan-tamu') ? 'active' : '' }}" href="/scan-tamu" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <span class="right-nav-text">Scan Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('daftar-tamu') ? 'active' : '' }}" href="/daftar-tamu" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <span class="right-nav-text">Daftar Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('daftar-admin') ? 'active' : '' }}" href="/daftar-admin" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <span class="right-nav-text">Daftar Admin</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('invoice') ? 'active' : '' }}" href="/invoice" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <span class="right-nav-text">Invoice</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <hr class="light-grey-hr mb-10" />
        </li>
        <li class="navigation-header">
            <span>PRODUK</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#ui_dr">
                <div class="pull-left">
                    <span class="right-nav-text">Paket Item</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->
