const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/js/jquery.slimscroll.js',
    'resources/js/jquery.waypoints.min.js',
    'resources/js/jquery.counterup.min.js',
    'resources/js/jquery.toast.min.js',
    'resources/js/sweetalert.min.js',
    'resources/js/init.js',
    'resources/js/fontawsome.js',
    'resources/js/lottie-player.js',
    'resources/js/printThis.js',
], 'public/js/app.js').version();

mix.styles([
    'resources/css/jquery.toast.min.css',
    'resources/css/sweetalert.css',
    'resources/css/jquery.dataTables.min.css',
], 'public/css/app.css').version();

mix.minify('public/css/app.css');
mix.minify('public/js/app.js');