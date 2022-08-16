<div class="fixed-sidebar-left mt-10">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Admin Dashboard</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" class="active">
                <div class="pull-left">
                    <span class="right-nav-text">Analisis Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <li>
            <a class="{{ Request::is('scan-tamu') ? 'active' : '' }}" href="scan-tamu">
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

        <li>
            <hr class="light-grey-hr mb-10" />
        </li>

        <li class="navigation-header">
            <span>Produk</span>
            <i class="zmdi zmdi-more"></i>
        </li>

        <li>
            <a href="#">
                <div class="pull-left">
                    <span class="right-nav-text">Paket Item</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

<!-- Left Sidebar Menu -->
<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>{{ auth()->user()->name }}</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" data-toggle="collapse"
                data-target="#dashboard_dr">
                <div class="pull-left">
                    <i class="zmdi zmdi-landscape mr-20"></i>
                    <span class="right-nav-text">Dashboard</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('scan-tamu') ? 'active' : '' }}" href="/scan-tamu" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <i class="zmdi zmdi-shopping-basket mr-20"></i>
                    <span class="right-nav-text">Scan Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('daftar-tamu') ? 'active' : '' }}" href="/daftar-tamu" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <i class="fa fa-users mr-20"></i>
                    <span class="right-nav-text">Daftar Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        {{-- hideadmin --}}
        @if (auth()->user()->id=='3')
        <li>
            <a class="{{ Request::is('daftar-admin') ? 'active' : '' }}" href="/daftar-admin" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <i class="fa fa-user mr-20"></i>
                    <span class="right-nav-text">Daftar Admin</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endif
        <li>
            <a class="{{ Request::is('invoice') ? 'active' : '' }}" href="/invoice" data-toggle="collapse"
                data-target="#ecom_dr">
                <div class="pull-left">
                    <i class="fa fa-money mr-20"></i>
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
                    <i class="zmdi zmdi-smartphone-setup mr-20"></i>
                    <span class="right-nav-text">Paket Bermain</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
    </ul>
</div>
<!-- /Left Sidebar Menu -->
</div>
