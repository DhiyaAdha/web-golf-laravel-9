<div class="fixed-sidebar-left" data-title="Sidebar Menu" data-intro="Bagian ini merupakan menu navigasi dan mempunyai fungsi sendiri di setiap menu">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        @if (auth()->user()->role_id == '2')
            <li class="navigation-header">
                <span>Super Admin</span>
                <i class="zmdi zmdi-more"></i>
            </li>
        @else
            <li class="navigation-header">
                <span>Admin</span>
                <i class="zmdi zmdi-more"></i>
            </li>
        @endif
        @if (auth()->user()->role_id == '2')
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard" class="collapsed {{ Request::is('analisis-tamu') || Request::is('revenue') ? 'active' : '' }}" aria-expanded="false" data-title="Menu Dashboard" data-intro="Menu ini digunakan untuk analisis pengunjung TGCC">
                    <div class="pull-left"><i class="fa fa-bar-chart-o mr-20"></i><span class="right-nav-text">Dashboard</span></div>
                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="dashboard" class="collapse-level-1 two-col-list collapse" aria-expanded="false" style="height: 0px;">
                    <li>
                        <a class="{{ Request::is('analisis-tamu') ? 'active-page' : '' }}" href="{{ route('analisis-tamu.index') }}">
                            <div class="pull-left">
                                <span class="right-nav-text">Analisis Tamu</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('revenue') ? 'active-page' : '' }}" href="{{ route('revenue.index') }}">
                            <div class="pull-left">
                                <span class="right-nav-text">Revenue</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#pos" class="collapsed {{ Request::is('scan-tamu') || Request::is('proses_reguler') ? 'active' : '' }}" aria-expanded="false" data-title="Menu POS" data-intro="Menu ini digunakan untuk proses transaksi TGCC">
                <div class="pull-left">
                    <i class="zmdi zmdi-google-pages mr-20"></i>
                    <span class="right-nav-text">Point of Sales</span>
                </div>
                <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="pos" class="collapse-level-1 two-col-list collapse" aria-expanded="false" style="height: 0px;">
                <li>
                    <a class="{{ Request::is('scan-tamu') ? 'active-page' : '' }}" href="{{ route('scan-tamu') }}">
                        <div class="pull-left">
                            <span class="right-nav-text">Scan QR Code</span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::is('proses_reguler') ? 'active-page' : '' }}" href="{{ route('proses_reguler') }}">
                        <div class="pull-left">
                            <span class="right-nav-text">Umum</span>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </li>
            </ul>
        </li>
        @if (auth()->user()->role_id == '1')
            <li>
                <a class="{{ Request::is('daftar-tamu') ? 'active' : '' }}" href="{{ route('daftar-tamu') }}" data-title="Menu Daftar Tamu" data-intro="Menu ini digunakan mengelola data member">
                    <div class="pull-left">
                        <i class="fa fa-user mr-20"></i>
                        <span class="right-nav-text">Daftar Tamu</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
        @endif
        @if (auth()->user()->role_id == '2')
            <li>
                <a href="javascript:void(0);" data-toggle="collapse" data-target="#pages_users" class="collapsed {{ Request::is('daftar-admin') || Request::is('daftar-tamu') ? 'active' : '' }}" aria-expanded="false" data-title="Menu Daftar Pengguna" data-intro="Menu ini digunakan mengelola data member dan berisi informasi detail riwayat bermain member">
                    <div class="pull-left"><i class="fa fa-user mr-20"></i><span class="right-nav-text">Daftar Pengguna</span></div>
                    <div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
                    <div class="clearfix"></div>
                </a>
                <ul id="pages_users" class="collapse-level-1 two-col-list collapse" aria-expanded="false" style="height: 0px;">
                    <li>
                        <a class="{{ Request::is('daftar-admin') ? 'active-page' : '' }}" href="{{ route('daftar-admin') }}">
                            <div class="pull-left">
                                <span class="right-nav-text">Daftar Admin</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a class="{{ Request::is('daftar-tamu') ? 'active-page' : '' }}" href="{{ route('daftar-tamu') }}">
                            <div class="pull-left">
                                <span class="right-nav-text">Daftar Tamu</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ Request::is('riwayat-invoice') ? 'active' : '' }}" href="{{ route('riwayat-invoice.index') }}" data-title="Menu Invoice" data-intro="Menu ini berisi riwayat daftar invoice member">
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
                <a class="{{ Request::is('package') ? 'active' : '' }}" href="{{ route('package.index') }}" data-title="Menu Daftar Paket" data-intro="Menu ini berisi daftar paket bermain TGCC, fasilitas yang tersedia dan penyewaan, dan kantin (daftar barang yang dapat dibeli)">
                    <div class="pull-left">
                        <i class="zmdi zmdi-smartphone-setup mr-20"></i>
                        <span class="right-nav-text">Paket Bermain</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
        @endif
    </ul>
</div>