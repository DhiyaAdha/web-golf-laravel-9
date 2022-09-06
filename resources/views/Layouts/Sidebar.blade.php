<div class="fixed-sidebar-left mt-10">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Admin Dashboard</span>
            <i class="zmdi zmdi-more"></i>
        </li>
        <li>
                <a class="{{ Request::is('analisis-tamu') ? 'active' : '' }}" href="{{ route('analisis-tamu.index') }}">
                <div class="pull-left">
                    <i class="fa fa-bar-chart-o mr-20"></i>
                    <span class="right-nav-text">Analisis Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('scan-tamu') ? 'active' : '' }}" href="scan-tamu">
                <div class="pull-left">
                    <i class="fa fa-camera-retro mr-20"></i>
                    <span class="right-nav-text">Scan Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <li>
            <a class="{{ Request::is('daftar-tamu') ? 'active' : '' }}" href="{{ route('daftar-tamu') }}">
                <div class="pull-left">
                    <i class="fa fa-user mr-20"></i>
                    <span class="right-nav-text">Daftar Tamu</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        {{-- hideadmin --}}
        @if (auth()->user()->role_id == '1')
            <li>
                <a class="{{ Request::is('daftar-admin') ? 'active' : '' }}" href="daftar-admin">
                    <div class="pull-left">
                        <i class="fa fa-user mr-20"></i>
                        <span class="right-nav-text">Daftar Admin</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            @endif
        <li>
            <a class="{{ Request::is('riwayat-invoice') ? 'active' : '' }}" href="{{ route('riwayat-invoice.index') }}">
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
            <a class="{{ Request::is('package') ? 'active' : '' }}" href="{{ route('package.index') }}">
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