<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScanqrController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PackageController;
use App\Mail\SendEmailReset;

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
// Route::get('/', function () {
//     if (Auth::user('role_id') == '2') {
//         return redirect('/analisis-tamu');
//     }else {
//         return redirect('/scan-tamu');
//     }
//     return view('Login');
// });
Route::get('/test', function ()
{
    return view('emails.sample');
});

Route::post('/lupa-pasword',[AuthController::class, 'email_test'])->name('email_test');

//untuk route login
    Route::get('/login', [AuthController::class, 'index'])->Middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    //Route untuk sebelum Login
    Route::get('/lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
    // Route::post('/lupa-pasword', [AuthController::class, 'sendresetlink'])->name('Lupa-pasword.link');
    Route::get('/reset-pasword/{token}', [AuthController::class,'showResetForm'])->name('Reset-pasword');
    Route::post('/reset-pasword', [AuthController::class, 'resetPassword'])     ->name('Reset-pasword.update');
    //untuk route logout
    Route::get('/logout', [AuthController::class, 'logout']);

    //Level superadmin
Route::group(['middleware' => ['auth', 'ceklevel:2']], function () {
    Route::get('/daftar-admin', [AdminController::class, 'index'])->name('daftar-admin');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/daftar-admin/{id}', [AdminController::class, 'show'])->name('show');
    Route::get('/daftar-admin/{id}', [AdminController::class, 'index'])->name('index');
    Route::get('/tambah-admin', [AdminController::class, 'tambahadmin'])->name('tambah-admin');
    Route::get('/admin-tambah-show', [AdminController::class, 'create'])->name('admin.show');
    Route::get('/admin-tambah', [AdminController::class, 'store'])->name('admin.tambah');
    Route::post('/insertadmin', [AdminController::class, 'insertadmin'])->name('insertadmin');
    Route::get('/edit-admin/{users}', [AdminController::class, 'edit'])->name('edit-admin');
    Route::post('/edit-admin/{users}', [AdminController::class, 'update'])->name('admin.edit');
    Route::get('/daftar-admin/destroy/{id}', [AdminController::class,'delete',])->name('hapus-admin');
    Route::get('aktifitas', [AdminController::class, 'aktifitas'])->name('admin.aktifitas');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('/package/edit/{package}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/update/{id}', [PackageController::class,'update'])->name('package.update');
    Route::resource('package', PackageController::class)->except(['show','update']);
    Route::get('/package/destroy/{id}', [PackageController::class,'destroy'])->name('package.destroy');
    Route::resource('riwayat-invoice', InvoiceController::class)->except(['show','update']);
    Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('show');
    route::get('/invoice_cetakpdf/{id}', [InvoiceController::class, 'cetak_pdf'])->name('cetak_pdf');
    route::get('/export_excel', [InvoiceController::class, 'export_excel'])->name('export_excel');
});

//Level admin dan superadmin
Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::resource('analisis-tamu', DashboardController::class);
    Route::get('/scan-tamu', [ScanqrController::class, 'index'])->name('scan-tamu');
    Route::get('/visitor/qrcode', [ScanqrController::class, 'checkQRCode'])->name('visitor.qrcode');
    Route::get('qrcode/{id}', [ScanqrController::class, 'generate'])->name('generate');
    Route::get('/kartu-tamu', [ScanqrController::class, 'kartutamu'])->name('kartu-tamu');
    Route::get('/kartu-member/{e}', [ScanqrController::class, 'show_detail'])->name('detail-scan')->middleware('signed');
    Route::post('update/deposit/{id}', [ScanqrController::class, 'update_deposit'])->name('update.deposit')->middleware('signed');
    Route::get('/daftar-tamu', [TamuController::class, 'index'])->name('daftar-tamu');
    Route::get('/daftar-tamu/destroy/{id}', [TamuController::class,'delete'])->name('hapus-tamu');
    Route::get('/tambah-tamu', [TamuController::class, 'tambahtamu'])->name('tambah-tamu');
    Route::post('/inserttamu', [TamuController::class, 'inserttamu'])->name('inserttamu');
    Route::get('/edit-tamu', [TamuController::class, 'edit'])->name('edit-tamu');
    Route::post('/update-tamu', [TamuController::class, 'update'])->name('update-tamu');
    Route::get('/daftar-tamu/destroy/{id}', [TamuController::class,'delete'])->name('daftar-tamu.delete');
    Route::get('/edit-tamu/{id}', [TamuController::class, 'edit'])->name('edit-tamu');
    Route::get('/daftar-tamu/destroy/{id}', [TamuController::class,'delete'])->name('hapus-tamu');
    Route::post('/update-tamu/{id}', [TamuController::class, 'update'])->name('update-tamu');
    Route::get('/tambah-deposit/{id}', [TamuController::class,'tambahdeposit'])->name('tambah-deposit');
    Route::get('/kartu-tamu/{id}', [TamuController::class, 'show'])->name('show');
    Route::get('deposit/{id}', [TamuController::class, 'deposittamu'])->name('deposittamu');
    Route::get('reportdeposit', [TamuController::class, 'reportdeposit'])->name('deposit.report');
    Route::get('/aktifitas-kartu-tamu/{id}', [TamuController::class, 'updatedeposit'])->name('updatedeposit');
    Route::get('/aktifitas-kartu-tamu/{id}', [TamuController::class, 'createdeposit'])->name('createdeposit');
    Route::get('reportlimit', [TamuController::class, 'reportlimit'])->name('limit.report');
    Route::get('transaksideposit', [TamuController::class, 'transaksideposit'])->name('transaksideposit');
    Route::get('transaksilimit', [TamuController::class, 'transaksilimit'])->name('transaksilimit');
    Route::get('reportdeposit/{id}', [TamuController::class, 'reportdeposit'])->name('deposit.report.data');
    Route::get('reportlimit/{id}', [TamuController::class, 'reportlimit'])->name('limit.report.data');
    Route::get('reporttransaksi/{id}', [TamuController::class, 'reporttransaksi'])->name('transaksi.report.data');
    Route::post('/tambah-deposit', [TamuController::class, 'insertdeposit'])->name('insertdeposit');
    Route::get('/proses', [OrderController::class, 'index'])->name('proses');
    Route::get('/cart/{id}', [OrderController::class, 'index'])->name('order.cart');
    Route::resource('cart', OrderController::class);
    Route::get('/cart/add/{package}', [OrderController::class, 'add'])->name('cart.add');
    Route::get('/cart/remove/{package}',[OrderController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/remove/all/{package}',[OrderController::class, 'remove_all'])->name('cart.remove_all');
    Route::get('/checkout/{id}', [OrderController::class,'checkout'])->name('checkout')->middleware('signed');
    Route::get('/select', [OrderController::class,'select'])->name('select.type');
});
