<!DOCTYPE html>
<html lang="id">

{{-- Head --}}
@include('Layouts.Header')
{{-- /Head --}}

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!-- /Preloader -->
    <div class="wrapper theme-1-active pimary-color-red">

        <!-- Top Menu Items -->
        @include('Layouts.Nav')
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        @include('Layouts.Sidebar')
        <!-- /Left Sidebar Menu -->



        <!-- Main Content -->
        @yield('content')
        <!-- /Main Content -->

    </div>
    {{-- Script --}}
    @include('Layouts.Script')
    {{-- /Script --}}

</body>

</html>
