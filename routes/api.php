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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/uuid', [UserController::class, 'fetchUserByUUID'])->name('uuid');
    Route::get('/active', [UserController::class, 'fetchActiveUsers'])->name('active');
    Route::get('/inactive', [UserController::class, 'fetchInactiveUsers'])->name('inactive');
    Route::post('/disable', [UserController::class, 'disableAccount'])->name('disable');
    Route::post('/activate', [UserController::class, 'activateAccount'])->name('activate');
});
