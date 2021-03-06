<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/demo', [UserController::class, 'demo2']);
Route::get('/users/{id}', [UserController::class, 'detail']);
Route::put('/users/{id}', [UserController::class, 'updateUser']);
Route::post('/users', [UserController::class, 'demo']);
Route::delete('/users/{id}', [UserController::class, 'delete']);
