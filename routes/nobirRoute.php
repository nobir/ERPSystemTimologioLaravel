<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [TestController::class, 'login'])->name('login');

Route::controller(TestController::class)->middleware('loggedin')->group(function () {
    Route::get('/', 'index')->name('test');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/login', 'login')->middleware('notloggedin')->name('home.login');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/logout', 'logout')->name('home.logout');

    Route::post('/login', 'loginSubmit')->name('home.loginSubmit');
});

Route::controller(DashboardController::class)->middleware('loggedin')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard.index');
});
