<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\TestController;
use Illuminate\Support\Facades\Route;

Route::controller(TestController::class)->group(function () {
    Route::post('/test', 'index')->name('test');
});

Route::controller(HomeController::class)->group(function () {
    Route::post('/login', 'loginSubmit')->name('api.home.loginSubmit');
    Route::post('/logout', 'logout')->name('api.home.logout')->middleware('isauthuserapi');

    Route::get('email-verify/{user_id}/{code}', 'emailVerify')->name('api.home.emailVerify')
        ->whereNumber(['user_id', 'code']);
});



Route::controller(DashboardController::class)
    ->prefix('dashboard')
    ->middleware('isauthuserapi')
    ->group(function () {
        Route::get('/edit-profile', 'profileEdit')->name('api.dashboard.profileEdit');
        Route::post('/edit-profile', 'profileEditSubmit')->name('api.dashboard.profileEditSubmit');
        Route::post('/profile', 'profile')->name('api.dashboard.profile');
        Route::post('/change-profile-picture', 'profilePictureSubmit')->name('dashboard.profilePictureSubmit');
        Route::post('/change-password', 'changePasswordSubmit')->name('api.dashboard.changePasswordSubmit');
    });



Route::controller(AdminController::class)
    ->prefix('admin')
    ->middleware(['isauthuserapi', 'isadminuserapi'])
    ->group(function () {
        // Route::get('/', 'index')->name('admin.index');
        Route::get('/view-users', 'viewUsers')->name('api.dashboard.viewUsers');
        Route::post('/view-users', 'viewSearchUsers')->name('api.dashboard.searchUsersSubmit');

        Route::get('/verify-users', 'viewUnverifiedUsers')->name('api.dashboard.viewUnverifiedUsers');
        Route::post('/verify-users', 'viewSearchUnverifiedUsers')->name('api.dashboard.viewSearchUnverifiedUsers');

        Route::post('/verify-user/{id}', 'verifyUser')->name('api.admin.verifyUser');
        Route::post('/unverify-user/{id}', 'unverifyUser')->name('api.admin.unverifyUser');

        Route::get('/add-user', 'createUser')->name('api.admin.createUser');
        Route::post('/add-user', 'createUserSubmit')->name('api.admin.createUserSubmit');

        Route::get('/edit-user/{id}', 'editUser')->name('api.admin.editUser');
        Route::post('/edit-user/{id}', 'editUserSubmit')->name('api.admin.editUserSubmit');

        Route::post('/delete-user/{id}', 'deleteUser')->name('api.admin.deleteUser')->whereNumber('id');

        Route::get('/view-permissions', 'viewPermissions')->name('api.dashboard.viewPermissions');
        Route::post('/view-permissions', 'viewSearchPermissions')->name('api.dashboard.viewSearchPermissions');

        Route::post('/add-permission', 'addPermissionSubmit')->name('api.dashboard.addPermissionSubmit');
        Route::get('/edit-permission/{id}', 'editPermission')->name('api.admin.editPermission')->whereNumber('id');
        Route::post('/edit-permission/{id}', 'editPermissionSubmit')->name('api.admin.editPermissionSubmit')->whereNumber('id');
        Route::post('/delete-permission/{id}', 'deletePermission')->name('api.admin.deletePermission')->whereNumber('id');

        Route::get('/category-statistic', 'viewStatistic')->name('api.dashboard.verifyUser');

        // Users
        // Route::get('/user/create', 'createUser')->name('admin.createUser');
        // Route::post('/user/create', 'createUserSubmit')->name('admin.createUserSubmit');

        // Route::get('/users', 'viewUsers')->name('admin.viewUsers');
        // Route::get('/unverifiedUsers', 'viewUnverifiedUsers')->name('admin.viewUnverifiedUsers');

        // Route::get('/users/{search_by}/{search_value}', 'viewSearchUsers')->name('admin.viewSearchUsers');
        // Route::get('/unverifiedUsers/{search_by}/{search_value}', 'viewSearchUnverifiedUsers')->name('admin.viewSearchUnverifiedUsers');

        // Route::get('/searchUsers', 'searchUsers')->name('admin.searchUsers');
        // Route::post('/searchUsers', 'searchUsersSubmit')->name('admin.searchUsersSubmit');

        // Route::get('/searchUnverifiedUsers', 'searchUnverifiedUsers')->name('admin.searchUnverifiedUsers');
        // Route::post('/searchUnverifiedUsers', 'searchUnverifiedUsersSubmit')->name('admin.searchUnverifiedUsersSubmit');

        // Route::get('/verify-users/{id}', 'verifyUser')->name('admin.verifyUser');
        // Route::get('/unverify-users/{id}', 'unverifyUser')->name('admin.unverifyUser');
        // Route::post('/send-email-verification-link', 'sendEmailVerifyLinkSubmit')->name('api.admin.sendEmailVerifyLinkSubmit');

        // Route::get('/user/edit/{id}', 'editUser')->name('admin.editUser')->whereNumber('id');
        // Route::post('/user/edit/{id}', 'editUserSubmit')->name('admin.editUserSubmit')->whereNumber('id');

        // Route::get('/user/delete/{id}', 'deleteUser')->name('admin.deleteUser')->whereNumber('id');

        // // Permission
        // Route::get('/permissions', 'viewPermissions')->name('admin.viewPermissions');

        // Route::get('/permission/create', 'createPermission')->name('admin.createPermission');
        // Route::post('/permission/create', 'createPermissionSubmit')->name('admin.createPermissionSubmit');

        // Route::get('/permission/edit/{id}', 'editPermission')->name('admin.editPermission')->whereNumber('id');
        // Route::post('/permission/edit/{id}', 'editPermissionSubmit')->name('admin.editPermissionSubmit')->whereNumber('id');

        // Route::get('/permission/delete/{id}', 'deletePermission')->name('admin.deletePermission')->whereNumber('id');
    });
