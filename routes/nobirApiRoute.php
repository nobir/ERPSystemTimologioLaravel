<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::controller(TestController::class)->middleware("isauthuserapi")->group(function () {
    Route::post('/test', 'index')->name('test');
});

Route::controller(HomeController::class)->group(function () {
    Route::post('/login', 'loginSubmit')->name('api.home.loginSubmit');
    Route::post('/logout', 'logout')->name('api.home.logout')->middleware('isauthuserapi');

    Route::get('emailVerify/{user_id}/{code}', 'emailVerify')->name('api.home.emailVerify')
        ->whereNumber(['user_id', 'code']);
});

Route::controller(DashboardController::class)->group(function () {
});
