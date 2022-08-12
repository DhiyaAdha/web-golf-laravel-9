<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;



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
    return view('login');
    });<?php

    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ForgotPasswordController;
    use App\Http\Controllers\ResetPasswordController;
    
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
        return view('login');
        });
    
        //untuk route login
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
    
    // Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest');
    // Route::post('/Lupa-pasword', [AuthController::class, 'sendresetlink'])->name('/Lupa-pasword');
    // Route::get('/Reset-pasword', [AuthController::class, 'password_baru']);
    
    //untuk route logout
    Route::get('/logout', [AuthController::class, 'logout']);
    
    
    //level admin dan superadmin
    Route::group(['middleware' => ['auth','ceklevel:1,3']], function() {
    Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
    Route::get('/daftar-admin', [AuthController::class, 'daftar-admin'])->name('daftar-admin');
    });
    
    
    Route::group(['middleware' => ['auth','ceklevel:1,3,4,9,10,5,8']], function() {
        Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
        Route::get('/daftar-admin', [AuthController::class, 'daftar-admin'])->name('daftar-admin');
    });
    
    Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
    Route::post('/Lupa-pasword',[AuthController::class,'sendresetlink'])->name('Lupa-pasword.link');
    
    Route::get('/Reset-pasword/{token}',[AuthController::class,'showResetForm'])->name('Reset-pasword');
    Route::post('/Reset-pasword',[AuthController::class,'resetPassword'])->name('Reset-pasword.update');
    
    

    //untuk route login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

<<<<<<< HEAD
// Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
=======
Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard', function () {
    return view('Analisis-tamu');
});
Route::get('/scan-tamu', function () {
    return view('Scan-tamu');
});
>>>>>>> yudis

// Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest');
// Route::post('/Lupa-pasword', [AuthController::class, 'sendresetlink'])->name('/Lupa-pasword');
// Route::get('/Reset-pasword', [AuthController::class, 'password_baru']);

//untuk route logout
Route::get('/logout', [AuthController::class, 'logout']);


//level admin dan superadmin
Route::group(['middleware' => ['auth','ceklevel:1,3']], function() {
Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
Route::get('/daftar-admin', [AuthController::class, 'daftar-admin'])->name('daftar-admin');
});


Route::group(['middleware' => ['auth','ceklevel:1,3,4,9,10,5,8']], function() {
    Route::get('/analisis-tamu', [AuthController::class, 'dashboard'])->middleware('auth');
    Route::get('/daftar-admin', [AuthController::class, 'daftar-admin'])->name('daftar-admin');
});

Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest')->name('Lupa-pasword');
Route::post('/Lupa-pasword',[AuthController::class,'sendresetlink'])->name('Lupa-pasword.link');

Route::get('/Reset-pasword/{token}',[AuthController::class,'showResetForm'])->name('Reset-pasword');
Route::post('/Reset-pasword',[AuthController::class,'resetPassword'])->name('Reset-pasword.update');

