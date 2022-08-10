<!DOCTYPE html>
<html lang="en">

@include('Layouts.Header')

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

    </div>
    <!-- /#wrapper -->

    {{-- Script --}}
    @include('Layouts.Script')
</body>
</html>