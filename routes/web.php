<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\NotificationController;

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
    return Inertia::render('Welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/{user}', [UserController::class, 'update'])->name('user.update');
        Route::post('/', [UserController::class, 'store'])->name('user.store');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/', [NotificationController::class, 'store'])->name('notification.store');
    });

    Route::group(['prefix' => 'impersonate/{user}'], function () {
        Route::get('/', [ImpersonateController::class, 'index'])->name('impersonate');
        Route::post('/read/{notification}', [ImpersonateController::class, 'read'])->name('impersonate.read');
    });    
});