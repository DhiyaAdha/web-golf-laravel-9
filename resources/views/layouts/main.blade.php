<!DOCTYPE html>
<html lang="id">
@include('layouts.header')
<body>
    <div class="se-pre-con"></div>
    <div class="wrapper theme-1-active pimary-color-red">
        @include('layouts.nav')
        @include('layouts.sidebar')
        @yield('content')
    </div>
    @include('layouts.script')
</body>
</html>
