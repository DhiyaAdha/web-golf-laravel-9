<?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\InvoiceController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\OrderRegulerController;
    use App\Http\Controllers\PackageController;
    use App\Http\Controllers\RevenueController;
    use App\Http\Controllers\ScanqrController;
    use App\Http\Controllers\TamuController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

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

Route::middleware(['htmlMinifier'])->group(static function () {
    Route::get('/', function () {
        if (Auth::user()) {
            return redirect('/analisis-tamu');
        }

        return view('login');
    });
    Route::post('/forgot-password', [AuthController::class, 'email_test'])->name('email_test');
    Route::get('/login', [AuthController::class, 'index'])->Middleware('guest')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->middleware('guest')->name('forgot-password');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('reset-password');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password.update');
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth', 'ceklevel:2']], function () {
    Route::post('/insertadmin', [AdminController::class, 'insertadmin'])->name('insertadmin');
    Route::post('/edit-admin/{users}', [AdminController::class, 'update'])->name('admin.edit');
    Route::post('/daftar-admin/destroy', [AdminController::class, 'delete'])->name('hapus-admin');
    Route::get('/aktifitas', [AdminController::class, 'aktifitas'])->name('admin.aktifitas');
    Route::post('update/password/{id}', [AdminController::class, 'update_password'])->name('update.password');
    route::get('/invoice_cetakpdf/{id}', [InvoiceController::class, 'cetak_pdf'])->name('cetak_pdf');
    route::get('/export_excel', [InvoiceController::class, 'export_excel'])->name('export_excel');
    Route::get('/package/edit/{package}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('/package/update/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::post('/package/destroy', [PackageController::class, 'destroy'])->name('package.destroy');
    Route::post('/package/store', [PackageController::class, 'store'])->name('package.store');
    Route::middleware(['htmlMinifier'])->group(static function () {
        Route::resource('revenue', RevenueController::class);
        Route::get('/analytic/week', [DashboardController::class, 'analytic_week'])->name('analytic.week');
        Route::get('/analytic/week/revenue', [RevenueController::class, 'analytic_week_revenue'])->name('analytic.week.revenue');
        Route::get('/analytic/month', [DashboardController::class, 'analytic_month'])->name('analytic.month');
        Route::get('/analytic/month/revenue', [RevenueController::class, 'analytic_month_revenue'])->name('analytic.month.revenue');
        Route::get('/daftar-admin', [AdminController::class, 'index'])->name('daftar-admin');
        Route::get('/tambah-admin', [AdminController::class, 'tambahadmin'])->name('tambah-admin');
        Route::get('/edit-admin/{users}', [AdminController::class, 'edit'])->name('edit-admin');
        Route::resource('/riwayat-invoice', InvoiceController::class)->except(['show', 'update']);
        Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('show');
        Route::get('/package', [PackageController::class, 'index'])->name('package.index');
        Route::get('/package/tambah-package', [PackageController::class, 'create'])->name('package.create');
    });
});

Route::group(['middleware' => ['auth', 'ceklevel:1,2']], function () {
    Route::get('/verification/identity', [ScanqrController::class, 'checkNIK'])->name('visitor.nik');
    Route::get('/visitor/qrcode', [ScanqrController::class, 'checkQRCode'])->name('visitor.qrcode');
    Route::get('/visitor/phone', [ScanqrController::class, 'checkNoHp'])->name('visitor.phone');
    Route::post('update/deposit/{id}', [ScanqrController::class, 'update_deposit'])->name('update.deposit')->middleware('signed');
    Route::post('/inserttamu', [TamuController::class, 'inserttamu'])->name('inserttamu');
    Route::post('/daftar-tamu/destroy', [TamuController::class, 'delete'])->name('hapus-tamu');
    Route::post('/update-tamu/{id}', [TamuController::class, 'update'])->name('update-tamu');
    Route::get('/tambah-deposit/{id}', [TamuController::class, 'tambahdeposit'])->name('tambah-deposit');
    Route::get('reportdeposit', [TamuController::class, 'reportdeposit'])->name('deposit.report');
    Route::get('/aktifitas-kartu-tamu/{id}', [TamuController::class, 'updatedeposit'])->name('updatedeposit');
    Route::get('reportlimit', [TamuController::class, 'reportlimit'])->name('limit.report');
    Route::get('transaksideposit', [TamuController::class, 'transaksideposit'])->name('transaksideposit');
    Route::get('transaksilimit', [TamuController::class, 'transaksilimit'])->name('transaksilimit');
    Route::get('transaksicoupon', [TamuController::class, 'transaksicoupon'])->name('transaksicoupon');
    Route::get('/reporttransaksi/{id}', [TamuController::class, 'reporttransaksi'])->name('transaksi.report.data');
    Route::get('/reportdeposit/{id}', [TamuController::class, 'reportdeposit'])->name('deposit.report.data');
    Route::get('/reportlimit/{id}', [TamuController::class, 'reportlimit'])->name('limit.report.data');
    Route::get('/reportkupon/{id}', [TamuController::class, 'reportkupon'])->name('kupon.report.data');
    Route::post('/tambah-deposit', [TamuController::class, 'insertdeposit'])->name('insertdeposit');
    route::get('/export_excel_tamu', [TamuController::class, 'export_excel_tamu'])->name('export_excel_tamu');
    Route::post('update/kupon/{id}', [TamuController::class, 'update_kupon'])->name('update.kupon');
    Route::get('/proses', [OrderController::class, 'index'])->name('proses');
    Route::post('/cart/add', [OrderController::class, 'add'])->name('cart.add');
    Route::post('/update/qty', [OrderController::class, 'update_qty'])->name('update.qty');
    Route::post('/cart/remove', [OrderController::class, 'remove'])->name('remove.item');
    Route::post('/cart/clear', [OrderController::class, 'clear_cart'])->name('cart.clear');
    Route::get('/select', [OrderController::class, 'select'])->name('select.type');
    Route::post('/qty/minus/{id}', [OrderController::class, 'minus'])->name('qty.minus');
    Route::post('/pay', [OrderController::class, 'pay'])->name('pay');
    Route::middleware(['htmlMinifier'])->group(static function () {
        Route::resource('analisis-tamu', DashboardController::class);
        Route::get('/scan-tamu', [ScanqrController::class, 'index'])->name('scan-tamu');
        Route::get('/kartu-member/{e}', [ScanqrController::class, 'show_detail'])->name('detail-scan')->middleware('signed');
        Route::get('/cart/{id}', [OrderController::class, 'index'])->name('order.cart');
        Route::get('/checkout/{id}', [OrderController::class, 'checkout'])->name('checkout');
        Route::get('/print_invoice/{id}', [OrderController::class, 'print_invoice'])->name('invoice.print');
        Route::get('/proses_reguler', [OrderRegulerController::class, 'index'])->name('proses_reguler');
        Route::get('/checkout_reguler', [OrderRegulerController::class, 'checkout'])->name('checkout_reguler');
        Route::get('/print_invoice_reguler', [OrderRegulerController::class, 'print_invoice'])->name('invoice.print.reguler');
        Route::get('/daftar-tamu', [TamuController::class, 'index'])->name('daftar-tamu');
        Route::get('/tambah-tamu', [TamuController::class, 'tambahtamu'])->name('tambah-tamu');
        Route::get('/edit-tamu/{id}', [TamuController::class, 'edit'])->name('edit-tamu');
        Route::get('/kartu-tamu/{id}', [TamuController::class, 'show'])->name('show');
        Route::get('/print-kartu', [TamuController::class, 'printkartu'])->name('printkartu');

    });
    Route::post('/cart_add/reguler', [OrderRegulerController::class, 'add'])->name('cart_add.reguler');
    Route::post('/cart_remove/reguler', [OrderRegulerController::class, 'remove'])->name('cart_remove.reguler');
    Route::post('/reguler_update/qty', [OrderRegulerController::class, 'update_qty'])->name('reguler_update.qty');
    Route::post('/cart_reguler/clear', [OrderRegulerController::class, 'clear_cart'])->name('cart_reguler.clear');
    Route::post('/pay_reguler', [OrderRegulerController::class, 'pay_reguler'])->name('pay_reguler');
    Route::get('/detail-invoice-member/{id}', [TamuController::class, 'data_modal_invoice'])->name('modal.invoice');
});
