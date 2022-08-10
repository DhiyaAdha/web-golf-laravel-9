<div class="fixed-sidebar-left">
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
            <a href="#">
                <div class="pull-left">
                    <span class="right-nav-text">Package Item</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

</div>