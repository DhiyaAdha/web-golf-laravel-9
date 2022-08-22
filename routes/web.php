<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackageController;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ResetPasswordController;
use GuzzleHttp\Middleware;

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
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
    Route::get('/daftar-admin', [AuthController::class, 'daftar_admin'])->name('daftar-admin');
    Route::get('/invoice',[InvoiceController::class,'invoice'])->name('invoice');
    Route::get('/package-item',[PackageController::class,'item'])->name('package.item');
    Route::get('/scan-tamu',[AuthController::class,'scantamu'])->name('scan-tamu');
    Route::get('/scan-tamu-berhasil',[AuthController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    Route::get('/order',[AuthController::class,'order'])->name('order');
    Route::resource('package', PackageController::class)->except(['show','update']);
    Route::get('/daftar-tamu',[AuthController::class,'daftartamu'])->name('daftar-tamu');
    Route::get('/tambah-tamu',[AuthController::class,'tambahtamu'])->name('tambah-tamu');
    Route::post('/inserttamu',[AuthController::class,'inserttamu'])->name('inserttamu');
    route::get('qrcode/{id}', [AuthController::class, 'generate'])->name('generate');
    //Delete Daftar Tamu
    route::get('/daftar-tamu/hapus/{id}', [AuthController::class, 'hapus'])->name('hapus');
    Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');
    
    Route::get('/riwayat-invoice',[InvoiceController::class,'riwayatinvoice'])->name('riwayat-invoice');

});

//Level admin dan superadmin
Route::group(['middleware' => ['auth','ceklevel:1,2']], function() {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
    Route::get('/invoice',[InvoiceController::class,'invoice'])->name('invoice');
    Route::get('/package-item',[PackageController::class,'item'])->name('package.item');
    Route::get('/scan-tamu',[AuthController::class,'scantamu'])->name('scan-tamu');
    Route::get('/scan-tamu-berhasil',[AuthController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    Route::get('/order',[AuthController::class,'order'])->name('order');
    Route::get('/daftar-tamu',[AuthController::class,'daftartamu'])->name('daftar-tamu');
    Route::get('/tambah-tamu',[AuthController::class,'tambahtamu'])->name('tambah-tamu');
    Route::post('/inserttamu',[AuthController::class,'inserttamu'])->name('inserttamu');
    route::get('qrcode/{id}', [AuthController::class, 'generate'])->name('generate');
    //Delete Daftar Tamu
    route::get('/daftar-tamu/hapus/{id}', [AuthController::class, 'hapus'])->name('hapus');
    Route::get('/riwayat-invoice',[InvoiceController::class,'riwayatinvoice'])->name('riwayat-invoice');
    Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');
});

//Finish level admin dan superadmin

//Route untuk sebelum Login
Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
Route::post('/Lupa-pasword',[AuthController::class,'sendresetlink'])->name('Lupa-pasword.link');
Route::get('/Reset-pasword/{token}',[AuthController::class,'showResetForm'])->name('Reset-pasword');
Route::post('/Reset-pasword',[AuthController::class,'resetPassword'])->name('Reset-pasword.update');