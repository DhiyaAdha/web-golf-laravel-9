<!DOCTYPE html>
<html lang="id">
@include('layouts.header')
<body>
    <div class="se-pre-con slow-notice"></div>
    <div class="wrapper theme-1-active pimary-color-red" data-title="Selamat datang di TGCC" data-intro="Ini adalah aplikasi manajemen transaksi dan membership TGCC. Lihat bagian lain..">
        @include('layouts.nav')
        @include('layouts.sidebar')
        @yield('content')
    </div>
    @include('layouts.script')
</body>
</html>
