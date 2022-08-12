<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VisitorController;
use App\Models\Visitor;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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
    return view('login');
});

    //untuk route login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth');

Route::get('/Lupa-pasword', [AuthController::class, 'forgot_password'])->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout']);


//seeder
Route::get('/', function(){
    $statusmember = Visitor::get(); 

    dd($statusmember);
});


// Analisis Tamu
Route::get('/analisis-tamu', [VisitorController::class, 'index'])->name('analisis-tamu');

Route::get('/datavisitor', [VisitorController::class, 'store'])->name('datavisitor');