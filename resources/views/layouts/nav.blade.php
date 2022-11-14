<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <div class="nav-header pull-left">
            <div class="logo-wrap">
                <a href="/dashboard">
                    <img class="brand-img" src="{{ asset('dist/img/tgcc_icon.svg') }}" alt="brand" />
                    <span class="brand-text">TGCC</span>
                </a>
            </div>
        </div>
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"
            style="top:20;"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    <span><strong>{{ auth()->user()->name }}</strong></span>
                </a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="/logout"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                        @csrf
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
