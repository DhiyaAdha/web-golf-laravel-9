<?php

use GuzzleHttp\Middleware;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/dashboard');
    }    
    return view('Login');
});

//untuk route login
Route::get('/login', [AuthController::class, 'index'])->Middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login']);

//untuk route logout
Route::get('/logout', [AuthController::class, 'logout']);

//Level admin
Route::group(['middleware' => ['auth','ceklevel:1']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth');
    Route::get('/daftar-admin', [AuthController::class, 'daftar_admin'])->name('daftar-admin');
    Route::get('/invoice',[AuthController::class,'invoice'])->name('invoice');
    Route::get('/package-item',[PackageController::class,'item'])->name('package.item');
    Route::get('/scan-tamu',[AuthController::class,'scantamu'])->name('scan-tamu');
    Route::get('/scan-tamu-berhasil',[AuthController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    Route::get('/order',[AuthController::class,'order'])->name('order');
    Route::resource('package', PackageController::class)->except(['show','update']);
    Route::get('/daftar-tamu',[TamuController::class,'daftartamu'])->name('daftar-tamu');
    Route::get('/tambah-tamu',[TamuController::class,'tambahtamu'])->name('tambah-tamu');
    Route::post('/inserttamu',[TamuController::class,'inserttamu'])->name('inserttamu');
    route::get('qrcode/{id}', [AuthController::class, 'generate'])->name('generate');
    //Delete Daftar Tamu
    route::get('/daftar-tamu/hapus/{id}', [TamuController::class, 'hapus'])->name('hapus');
    Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');
    Route::get('/riwayat-invoice',[AuthController::class,'riwayatinvoice'])->name('riwayat-invoice');

});

//Level admin dan superadmin
Route::group(['middleware' => ['auth','ceklevel:1,2']], function() {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth');
    Route::get('/invoice',[AuthController::class,'invoice'])->name('invoice');
    Route::get('/package-item',[PackageController::class,'item'])->name('package.item');
    Route::get('/scan-tamu',[ScanController::class,'scantamu'])->name('scan-tamu');
    Route::get('/scan-tamu-berhasil',[ScanController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    Route::get('/order',[AuthController::class,'order'])->name('order');

    // Route: Daftar-tamu
    Route::get('/daftar-tamu',[TamuController::class,'daftartamu'])->name('daftar-tamu');
    Route::get('/tambah-tamu',[TamuController::class,'tambahtamu'])->name('tambah-tamu');
    Route::post('/inserttamu',[TamuController::class,'inserttamu'])->name('inserttamu');
    route::get('/daftar-tamu/hapus/{id}', [TamuController::class, 'hapus'])->name('hapus');
    route::get('qrcode/{id}', [ScanController::class, 'generate'])->name('generate');
    
    Route::get('/riwayat-invoice',[AuthController::class,'riwayatinvoice'])->name('riwayat-invoice');
    Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');
});

//Finish level admin dan superadmin

//Route untuk sebelum Login
Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
Route::post('/Lupa-pasword',[AuthController::class,'sendresetlink'])->name('Lupa-pasword.link');
Route::get('/Reset-pasword/{token}',[AuthController::class,'showResetForm'])->name('Reset-pasword');

Route::post('/Reset-pasword',[AuthController::class,'resetPassword'])->name('Reset-pasword.update');
// hello
