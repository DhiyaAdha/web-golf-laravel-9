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
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
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
    //Route untuk sebelum Login
    Route::get('/lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
    Route::post('/lupa-pasword', [AuthController::class, 'sendresetlink'])->name('Lupa-pasword.link');
    Route::get('/reset-pasword/{token}', [AuthController::class,'showResetForm'])->name('Reset-pasword');
    Route::post('/reset-pasword', [AuthController::class, 'resetPassword'])     ->name('Reset-pasword.update');
    //untuk route logout
    Route::get('/logout', [AuthController::class, 'logout']);

    //Level superadmin
Route::group(['middleware' => ['auth', 'ceklevel:1']], function () {
    Route::get('/package/destroy/{id}', [PackageController::class,'destroy'])->name('package.destroy');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/update/{id}', [PackageController::class,'update'])->name('package.update');
    Route::resource('analisis-tamu', DashboardController::class);
    Route::resource('package', PackageController::class)->except([
        'show',
        'update',
    ]);
    Route::resource('riwayat-invoice', InvoiceController::class)->except([
        'show',
        'update',
    ]);

    Route::get('/daftar-tamu', [TamuController::class, 'index'])->name(
        'daftar-tamu'
    );
    Route::get('/daftar-admin', [AdminController::class, 'index'])->name(
        'daftar-admin'
    );
    Route::get('/daftar-tamu/destroy/{id}', [TamuController::class,'delete',])->name('hapus-tamu');
    Route::get('/tambah-tamu', [TamuController::class, 'tambahtamu'])->name(
        'tambah-tamu'
    );
    Route::post('/inserttamu', [TamuController::class, 'inserttamu'])->name(
        'inserttamu'
    );
    Route::post('/store', [AdminController::class, 'store'])->name(
        'store'
    );
    Route::get('/edit-tamu', [TamuController::class, 'edit'])->name(
        'edit-tamu'
    );
    Route::post('/update-tamu', [TamuController::class, 'update'])->name(
        'update-tamu'
    );

    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name(
        'show'      
    );
    Route::get('/daftar-admin/{id}', [AdminController::class, 'show'])->name(
        'show'
    );
    Route::get('/daftar-admin/{id}', [AdminController::class, 'index'])->name(
        'index'
    );
    Route::get('/scan-tamu', [ScanqrController::class, 'index'])->name(
        'scan-tamu'
    );

    Route::get('/scan-tamu-berhasil', [
        ScanController::class,
        'scantamuberhasil',
    ])->name('scan-tamu-berhasil');
    route::get('qrcode/{id}', [ScanqrController::class, 'generate'])->name(
        'generate'
    );
    Route::get('/tambah-admin', [AdminController::class, 'tambahadmin'])->name(
        'tambah-admin'
    );
    Route::get('/daftar-tamu/destroy/{id}', [
        TamuController::class,
        'delete',
    ])->name('daftar-tamu.delete');
    Route::get('/tambah-admin', [AdminController::class, 'tambah_admin'])->name(
        'tambah-admin'
    );
    Route::get('/edit-admin/{id}', [AdminController::class, 'edit'])->name(
        'edit-admin'
    );
    Route::get('/daftar-admin/destroy/{id}', [AdminController::class,'delete',])->name('hapus-admin');
    //route untuk order
    Route::resource('proses', OrderController::class);
    Route::get('/metode_pembayaran', [InvoiceController::class,'metode_pembayaran'])->name('metode_pembayaran');
    
    // Tamu-controller
    Route::get('/daftar-tamu', [TamuController::class, 'index'])->name(
        'daftar-tamu'
    );
    Route::get('/daftar-tamu/destroy/{id}', [TamuController::class,'delete',
    ])->name('hapus-tamu');
    Route::get('/tambah-tamu', [TamuController::class, 'tambahtamu'])->name(
        'tambah-tamu'
    );
    Route::post('/inserttamu', [TamuController::class, 'inserttamu'])->name(
        'inserttamu'
    );
    Route::get('/edit-tamu', [TamuController::class, 'edit'])->name(
        'edit-tamu'
    );
    Route::post('/update-tamu', [TamuController::class, 'update'])->name(
        'update-tamu'
    );

    //Detail Scan
    Route::get('/detail_scan/{id}', [ScanqrController::class, 'detail_datapengunjung'])->name('detail_scan');
});

//Level admin dan superadmin
Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::resource('package', PackageController::class)->except([
        'show',
        'update',
    ]);
    Route::resource('riwayat-invoice', InvoiceController::class)->except([
        'show',
        'update',
    ]);
    Route::resource('package', PackageController::class)->except([
        'show',
        'update',
    ]);
    Route::resource('riwayat-invoice', InvoiceController::class)->except([
        'show',
        'update',
    ]);
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name(
        'show'
    );
    Route::resource('proses', OrderController::class);

    Route::get('/tambah-admin', [AuthController::class, 'tambahadmin'])->name(
        'tambah-admin'
    );

    Route::resource('analisis-tamu', DashboardController::class);
    // Tamu-Controller
    Route::get('/kartu-tamu/{id}', [TamuController::class, 'show'])->name('show');
    Route::get('deposit/{id}', [TamuController::class, 'deposittamu'])->name('deposittamu');
    Route::get('/tambah-deposit/{id}', [
        TamuController::class,
        'tambahdeposit',
    ])->name('tambah-deposit');
    Route::get('/daftar-tamu', [TamuController::class, 'index'])->name(
        'daftar-tamu'
    );
    Route::get('/daftar-tamu/destroy/{id}', [
        TamuController::class,
        'delete',
    ])->name('hapus-tamu');
    Route::get('/tambah-tamu', [TamuController::class, 'tambahtamu'])->name(
        'tambah-tamu'
    );
    Route::post('/inserttamu', [TamuController::class, 'inserttamu'])->name(
        'inserttamu'
    );
    Route::get('/edit-tamu/{id}', [TamuController::class, 'edit'])->name(
        'edit-tamu'
    );
    Route::post('/update-tamu/{id}', [TamuController::class, 'update'])->name(
        'update-tamu'
    );

    //Kartu Tamu
    Route::get('/kartu-tamu/{id}', [TamuController::class, 'show'])->name('show');
    Route::post('/tambah-deposit', [TamuController::class, 'insertdeposit'])->name(
        'insertdeposit'
    );

    //Detail Scan
    Route::get('/detail_scan/{id}', [ScanqrController::class, 'detail_datapengunjung'])->name(
        'detail_scan'
    );
    Route::get('/kartu-tamu', [ScanqrController::class, 'kartutamu'])->name(
        'kartu-tamu'
    );

    Route::get('/scan-tamu', [ScanqrController::class, 'scantamu'])->name(
        'scan-tamu'
    );
    Route::get('/scan-tamu-berhasil', [
        ScanqrController::class,
        'scantamuberhasil',
    ])->name('scan-tamu-berhasil');
    Route::get('/scan-tamu', [ScanqrController::class, 'index'])->name(
        'scan-tamu'
    );
    route::get('qrcode/{id}', [ScanqrController::class, 'generate'])->name(
        'generate'
    );
    Route::get('/tambah-deposit', [
        TamuController::class,
        'tambahdeposit',
    ])->name('tambah-deposit');
    Route::get('/kartu-tamu', [ScanqrController::class, 'kartutamu'])->name(
        'kartu-tamu'
    );
    Route::get('/tambah-admin', [AdminController::class, 'tambahadmin'])->name(
        'tambah-admin'
    );
    Route::post('/update-admin/{id}', [AdminController::class, 'update'])->name(
        'update-admin'
    );
    Route::resource('proses', OrderController::class);


    // Route::get('limittamu/{id}', [TamuController::class, 'limittamu'])->name('limittamu');
    Route::get('/kartu-tamu/{id}', [TamuController::class, 'show'])->name(
        'show'
    );
    Route::get('deposit/{id}', [TamuController::class, 'deposittamu'])->name(
        'deposittamu'
    );

    //Detail Scan
    Route::get('/detail_scan/{id}', [ScanqrController::class, 'detail_datapengunjung'])->name(
        'detail_scan'
    );

});
//Finish level admin dan superadmin
