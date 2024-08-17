<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('web.login');
    Route::post('login', 'login')->name('web.loginPost');
    Route::post('login-employee', 'loginEmployee')->name('web.loginEmployee');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::controller(DashboardController::class)->name('dashboard.')->group(function () {
        Route::get('/', 'index')->name('home');
        Route::get('change-lang/{lang}', 'changeLang')->name('changeLang');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::controller(PositionController::class)->prefix('positions')->name('positions.')->group(function () {
        Route::get('index', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::get('show/{id}', 'show')->name('show');
    });
});
