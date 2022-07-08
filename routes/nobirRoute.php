<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', [TestController::class, 'index'])->name('test');

Route::controller(TestController::class)->group(function () {
    Route::get('/test', 'index')->name('test');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/login', 'login')->middleware('notloggedin')->name('home.login');
    Route::get('/about', 'about')->name('home.about');
    Route::get('/logout', 'logout')->name('home.logout');

    Route::post('/login', 'loginSubmit')->name('home.loginSubmit');

    Route::get('emailVerify/{user_id}/{code}', 'emailVerify')->name('home.emailVerify')
        ->whereNumber(['user_id', 'code']);
});

Route::controller(DashboardController::class)->middleware('loggedin')->group(function () {
    Route::get('/dashboard', 'index')->name('dashboard.index');
});

Route::controller(AdminController::class)
    ->prefix('admin')
    ->middleware(['loggedin', 'isadminuser'])
    ->group(function () {
        Route::get('/', 'index')->name('admin.index');

        // Users
        Route::get('/user/create', 'createUser')->name('admin.createUser');
        Route::post('/user/create', 'createUserSubmit')->name('admin.createUserSubmit');
        Route::get('/users', 'viewUsers')->name('admin.viewUsers');
        Route::get('/unverifiedUsers', 'viewUnverifiedUsers')->name('admin.viewUnverifiedUsers');

        Route::get('/verifyUser/{id}', 'verifyUser')->name('admin.verifyUser');
        Route::get('/unverifyUser/{id}', 'unverifyUser')->name('admin.unverifyUser');
        Route::get('/emailVerify', 'sendEmailVerifyLink')->name('admin.sendEmailVerifyLink');
        Route::post('/emailVerify', 'sendEmailVerifyLinkSubmit')->name('admin.sendEmailVerifyLinkSubmit');
    });
