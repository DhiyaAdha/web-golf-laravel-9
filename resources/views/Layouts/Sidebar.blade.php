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


</div>
