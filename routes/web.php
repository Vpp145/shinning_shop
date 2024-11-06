<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login']);
    Route::group(['middleware' => ['admin']], function () {
        Route::match(['get', 'post'], 'dashboard', [AdminController::class, 'dashboard']);
        Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
        Route::post('check-current-password', [AdminController::class, 'checkCurrentPassword']);
        Route::match(['get', 'post'], 'update-admin-details', [AdminController::class, 'updateAdminDetails']);
        Route::get('logout', [AdminController::class, 'logout']);

        //cms-pages
        Route::get('cms-pages', [CmsController::class, 'index']);
        Route::post('update-cms-page-status', [CmsController::class, 'update']);
        Route::match(['get', 'post'], 'add-edit-cms-page/{id?}', [CmsController::class, 'edit']);
        Route::get('delete-cms-page/{id}', [CmsController::class, 'destroy']);

        //sub admins
        Route::get('sub-admins', [AdminController::class, 'subadmins']);
        Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
        Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin']);
        Route::match(['get', 'post'], 'add-edit-sub-admin/{id?}', [AdminController::class, 'addEditSubadmin']);
        Route::match(['get', 'post'], 'update-role/{id}', [AdminController::class, 'updateRole']);

        //categories
        Route::get('categories', [CategoryController::class, 'categories']);
        Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
        Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory']);
    });
});
