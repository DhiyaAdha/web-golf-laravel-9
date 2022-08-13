<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\VisitorApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // return $request->user();
//     Route::post('logout', [AuthController::class, 'logout']);
// });

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function(){
    Route::post('logout', [AuthController::class, 'logout']);
});


// API Dhiya
Route::get('/Visitors', function(){
    return response()->json(
        [
            "message" => "Get Method Success"

        ]
        );
});

Route::post('/Visitor', function(){
    return response()->json(
        [
            "message" => "Post Method Success"

        ]
        );
});

Route::put('/Visitor/{id}', function($id){
    return response()->json(
        [
            "message" => "PUT Method Success". $id

        ]
        );
});

Route::delete('/Visitor/{id}', function($id){
    return response()->json(
        [
            "message" => "DELETE Method Success".$id

        ]
        );
});