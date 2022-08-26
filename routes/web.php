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

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ScanqrController;

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
        return redirect('/analisis-tamu');
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
    // resource
    Route::resource('analisis-tamu', DashboardController::class);
    Route::resource('package', PackageController::class)->except(['show','update']);
    Route::resource('daftar-tamu', TamuController::class);


    // Route::get('/daftar-admin', [AuthController::class, 'daftar_admin'])->name('daftar-admin');
    // Route::get('/invoice',[AuthController::class,'invoice'])->name('invoice');
    // // Route::get('/scan-tamu',[ScanController::class,'scantamu'])->name('scan-tamu');
    // Route::get('/scan-tamu-berhasil',[ScanController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    // Route::get('/proses',[ScanController::class,'proses'])->name('proses');
    // Route::get('/order',[AuthController::class,'order'])->name('order');
    // Route::get('/tambah-tamu',[TamuController::class,'tambahtamu'])->name('tambah-tamu');
    // Route::post('/inserttamu',[TamuController::class,'inserttamu'])->name('inserttamu');
    // Route::post('/updatetamu/{id}',[TamuController::class,'updatetamu'])->name('updatetamu');
    // route::get('qrcode/{id}', [ScanController::class, 'generate'])->name('generate');
    // Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');
    // Route::resource('riwayat-invoice', InvoiceController::class)->except(['show','update']);
    // Route::get('/daftar-admin', [AuthController::class, 'daftar_admin'])->name('daftar-admin');
    // Route::get('/tambah-admin', [AuthController::class, 'tambah_admin'])->name('tambah-admin');
    // Route::get('/edit-admin', [AuthController::class, 'edit_admin'])->name('edit-admin');
    // Route::get('/edit-tamu',[TamuController::class,'edittamu'])->name('edit-tamu');
    
    // Route::get('/daftar-tamu',[TamuController::class,'daftartamu'])->name('daftar-tamu');
    // route::get('/daftar-tamu/{id}', [TamuController::class, 'destroy']);
    // hapus-tamu
    // route::get('/daftar-tamu/hapus/{id}', [TamuController::class, 'hapus'])->name('hapus');

    });

//Level admin dan superadmin
Route::group(['middleware' => ['auth','ceklevel:1,2']], function() {
    // resource
    Route::resource('analisis-tamu', DashboardController::class);
    Route::resource('package', PackageController::class)->except(['show','update']);
    Route::resource('riwayat-invoice', InvoiceController::class)->except(['show','update']);
    Route::resource('/daftar-tamu', TamuController::class)->except(['index','show','destroy', 'tambahtamu', 'inserttamu', 'updatetamu']);
    Route::resource('/Scan-tamu', ScanqrController::class);

    // Route: Daftar-tamu
    // Route::get('/tambah-tamu',[TamuController::class,'tambahtamu'])->name('tambah-tamu');
    // Route::post('/inserttamu',[TamuController::class,'inserttamu'])->name('inserttamu');


    // Route::get('/invoice',[AuthController::class,'invoice'])->name('invoice');
    // // Route::get('/scan-tamu',[ScanController::class,'scantamu'])->name('scan-tamu');
    // Route::get('/scan-tamu-berhasil',[ScanController::class,'scantamuberhasil'])->name('scan-tamu-berhasil');
    // Route::get('/order',[AuthController::class,'order'])->name('order');
    // Route::get('/tambah-deposit',[TamuController::class,'tambahdeposit'])->name('tambah-deposit');
    // Route::get('/kartu-tamu',[TamuController::class,'kartutamu'])->name('kartu-tamu');
    // route::get('qrcode/{id}', [ScanController::class, 'generate'])->name('generate');
    // // Route::resource('qrcode/{id}', ScanqrController::class)->except(['show', 'update']);
    // Route::get('/tambah-admin',[AuthController::class,'tambahadmin'])->name('tambah-admin');

    // hapus function
    // Route::get('/daftar-tamu/hapus/{id}', [TamuController::class, 'destroy'])->name('daftar-tamu.hapus');
    // Route::get('/daftar-tamu/hapus/{id}', [TamuController::class, 'destroy'])->name('hapus');
    // Route::resource('/daftar-tamu', TamuController::class);
    // Route::resource('/daftar-tamu', TamuController::class);
    
    
});

// //Finish level admin dan superadmin

// //Route untuk sebelum Login
// Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
// Route::post('/Lupa-pasword',[AuthController::class,'sendresetlink'])->name('Lupa-pasword.link');
// Route::get('/Reset-pasword/{token}',[AuthController::class,'showResetForm'])->name('Reset-pasword');
// Route::post('/Reset-pasword',[AuthController::class,'resetPassword'])->name('Reset-pasword.update');

