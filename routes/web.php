<?php

use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});





Route::group(['prefix' => 'account'], function () {

    Route::group(['middleware' => 'guest'], function () {

        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
        Route::post('processRegister', [LoginController::class, 'processRegister'])->name('account.processRegister');
    });
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
    });
});



Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

       
    });
    Route::group(['middleware' => 'admin.auth'], function () {
     
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('dashboard/updatepage/{id}', [AdminDashboardController::class, 'updatePage'])->name('dashboard.updatePage');
        Route::post('dashboard/update/{id}', [AdminDashboardController::class, 'update'])->name('dashboard.update');
        Route::get('dashboard/delete/{id}', [AdminDashboardController::class, 'delete'])->name('dashboard.delete');
        Route::get('dashboard/block/{id}', [AdminDashboardController::class, 'block'])->name('dashboard.block');
        Route::get('dashboard/unblock/{id}', [AdminDashboardController::class, 'unblock'])->name('dashboard.unblock');
       

    });
});




