<div class="fixed-sidebar-left mt-10">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Admin Dashboard</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
            <a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard" class="active">
                <div class="pull-left">
                    <i class="fa fa-bar-chart-o mr-20"></i>
                    <span class="right-nav-text">Analisis Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('scan-tamu') ? 'active' : '' }}" href="scan-tamu" >
                <div class="pull-left">
                    <i class="fa fa-camera-retro mr-20"></i>
                    <span class="right-nav-text">Scan Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('daftar-tamu') ? 'active' : '' }}" href="/Daftar-tamu">
            {{-- <a class="{{ Request::is('Daftar-tamu') ? 'active' : '' }}" href="/daftar-tamu" > --}}
                <div class="pull-left">
                    <i class="fa fa-user mr-20"></i>
                    <span class="right-nav-text">Daftar Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        {{-- hideadmin --}}
        @if (auth()->user()->role_id=='1')
        <li>
            <a class="{{ Request::is('daftar-admin') ? 'active' : '' }}" href="/daftar-admin">
                <div class="pull-left">
                    <i class="fa fa-user mr-20"></i>
                    <span class="right-nav-text">Daftar Admin</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endif
        <li>
            <a class="{{ Request::is('invoice') ? 'active' : '' }}" href="/invoice">
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
            <a class="{{ Request::is('package-item') ? 'active' : '' }}" href="{{ route('package.item')}}">
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
