<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Helpers\WebApiHelper;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDocumentController;

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



Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login-page', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/registerStore', [RegisterController::class, 'registerStore'])->name('register.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth', 'authorize:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/user/my-profile', [UserController::class, 'index'])->name('user.my-profile');
});

Route::prefix('webapi')->name('webapi.')->group(function () {
    Route::name('general.')->group(function () {
        Route::get('/', [WebApiHelper::class, 'general'])->name('get');
        Route::post('/', [WebApiHelper::class, 'general'])->name('post');
    });
    // WEBAPI: SA
    Route::prefix('sa')->middleware('authorize:admin')->name('sa.')->group(function () {
        Route::get('/', [WebApiHelper::class, 'sa'])->name('get');
        Route::post('/', [WebApiHelper::class, 'sa'])->name('post');
    });
});

Route::prefix('document')->name('document.')->group(function () {
    Route::prefix('get')->name('get.')->group(function () {
        Route::get('/', [UserDocumentController::class, 'fetchStoredDocument'])->name('get');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/auth.php';
