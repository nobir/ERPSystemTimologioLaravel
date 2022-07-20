<?php

use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;


Route::controller(ManagerController::class)
    ->prefix('manager')
    ->middleware(['loggedin', 'ismanageruser'])
    ->group(function () {
        Route::get('/', 'index')->name('manager.index');

        // Branch
        Route::get('/branches', 'viewBranches')->name('manager.viewBranches');
        Route::get('/create/branch', 'createBranch')->name('manager.createBranch');
        Route::post('/create/branch', 'createBranchSubmit')->name('manager.createBranchSubmit');

        Route::get('/edit/branch/{id}', 'editBranch')->name('manager.editBranch')->whereNumber('id');
        Route::post('/edit/branch/{id}', 'editBranchSubmit')->name('manager.editBranchSubmit')->whereNumber('id');

        Route::get('/delete/branch/{id}', 'deleteBranch')->name('manager.deleteBranch');

        // Employee
        Route::get('/employees', 'viewEmployees')->name('manager.viewEmployees');

        Route::get('/create/employee', 'createEmployee')->name('manager.createEmployee');
        Route::post('/create/employee', 'createEmployeeSubmit')->name('manager.createEmployeeSubmit');

        Route::get('/employees/{search_by}/{search_value}', 'viewSearchEmployees')->name('manager.viewSearchEmployees');

        Route::get('/searchEmployees', 'searchEmployees')->name('manager.searchEmployees');
        Route::post('/searchEmployees', 'searchEmployeesSubmit')->name('manager.searchEmployeesSubmit');

        Route::get('/employee/edit/{id}', 'editEmployee')->name('manager.editEmployee')->whereNumber('id');
        Route::post('/employee/edit/{id}', 'editEmployeeSubmit')->name('manager.editEmployeeSubmit')->whereNumber('id');


        //category
        Route::get('/categories', 'viewCategories')->name('manager.viewCategories');

        Route::get('/create/category', 'createCategory')->name('manager.createCategory');
        Route::post('/create/category', 'createCategorySubmit')->name('manager.createCategorySubmit');

        Route::get('/edit/category/{id}', 'editCategory')->name('manager.editCategory')->whereNumber('id');
        Route::post('/edit/category/{id}', 'editCategorySubmit')->name('manager.editCategorySubmit')->whereNumber('id');

        Route::get('/delete/category/{id}', 'deleteCategory')->name('manager.deleteCategory')->whereNumber('id');
    });
