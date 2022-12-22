<?php

use App\Http\Controllers\Api\ManagerController;
use Illuminate\Support\Facades\Route;


Route::controller(ManagerController::class)
    ->prefix('manager')
    ->middleware(['isauthuserapi', 'isregionuserapi'])
    ->group(function () {
        // Branch
        Route::get('/view-branches', 'viewBranches')->name('api.manager.viewBranches');
        Route::post('/view-branches', 'viewSearchBranches')->name('api.manager.viewSearchBranches');
        // Route::get('/create/branch', 'createBranch')->name('api.manager.createBranch');
        Route::post('/add-branch', 'addBranchSubmit')->name('api.manager.addBranchSubmit');

        // Route::get('/edit/branch/{id}', 'editBranch')->name('api.manager.editBranch')->whereNumber('id');
        // Route::post('/edit/branch/{id}', 'editBranchSubmit')->name('api.manager.editBranchSubmit')->whereNumber('id');

        Route::post('/delete-branch/{id}', 'deleteBranchSubmit')->name('api.manager.deleteBranchSubmit');

        // Employee
        Route::get('/view-employees', 'viewEmployees')->name('api.manager.viewEmployees');
        Route::post('/view-employees', 'viewSearchEmployeeUsers')->name('api.manager.viewSearchEmployeeUsers');

        Route::get('/add-employee', 'addEmployee')->name('api.manager.addEmployee');
        Route::post('/add-employee', 'addEmployeeSubmit')->name('api.manager.addEmployeeSubmit');

        Route::post('/delete-employee/{id}', 'deleteEmployeeSubmit')->name('api.manager.deleteEmployeeSubmit');

        // Route::get('/employees/{search_by}/{search_value}', 'viewSearchEmployees')->name('api.manager.viewSearchEmployees');

        // Route::get('/searchEmployees', 'searchEmployees')->name('api.manager.searchEmployees');
        // Route::post('/searchEmployees', 'searchEmployeesSubmit')->name('api.manager.searchEmployeesSubmit');

        // Route::get('/employee/edit/{id}', 'editEmployee')->name('api.manager.editEmployee')->whereNumber('id');
        // Route::post('/employee/edit/{id}', 'editEmployeeSubmit')->name('api.manager.editEmployeeSubmit')->whereNumber('id');


        //category
        Route::get('/view-categories', 'viewCategories')->name('api.manager.viewCategories');
        Route::post('/view-categories', 'viewSearchCategories')->name('api.manager.viewSearchCategories');

        // Route::get('/add-category', 'addCategory')->name('api.manager.addCategory');
        Route::post('/add-category', 'addCategorySubmit')->name('api.manager.addCategorySubmit');

        // Route::get('/edit/category/{id}', 'editCategory')->name('api.manager.editCategory')->whereNumber('id');
        // Route::post('/edit/category/{id}', 'editCategorySubmit')->name('api.manager.editCategorySubmit')->whereNumber('id');

        Route::post('/delete-category/{id}', 'deleteCategorySubmit')->name('api.manager.deleteCategorySubmit');
    });
