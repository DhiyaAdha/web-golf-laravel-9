<!DOCTYPE html>
<html lang="id">

{{-- Head --}}
@include('layouts.header')
{{-- /Head --}}

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">

        <!-- Top Menu Items -->
        @include('layouts.nav')
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        @include('layouts.sidebar')
        <!-- /Left Sidebar Menu -->



        <!-- Main Content -->
        @yield('content')
        <!-- /Main Content -->

    </div>
    {{-- Script --}}
    @include('layouts.script')
    @stack('scripts')

    {{-- /Script --}}

</body>

</html>
