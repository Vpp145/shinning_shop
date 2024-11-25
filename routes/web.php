<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Front\IndexController;


//Admin
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
        Route::match(['get', 'post'], 'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory']);
        Route::get('delete-category-image/{id}', [CategoryController::class, 'deleteCategoryImage']);

        //products
        Route::get('products', [ProductController::class, 'products']);
        Route::post('update-product-status', [ProductController::class, 'updateProductStatus']);
        Route::get('delete-product/{id}', [ProductController::class, 'deleteProduct']);
        Route::match(['get', 'post'], 'add-edit-product/{id?}', [ProductController::class, 'addEditProduct']);
        Route::get('delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);
        Route::get('delete-product-image/{id}', [ProductController::class, 'deleteProductImage']);
        //attributes
        Route::post('update-attribute-status', [ProductController::class, 'updateAttributeStatus']);
        Route::get('delete-attribute/{id}', [ProductController::class, 'deleteAttribute']);

        //brands
        Route::get('brands', [BrandController::class, 'brands']);
        Route::post('update-brand-status', [BrandController::class, 'updateBrandStatus']);
        Route::get('delete-brand/{id}', [BrandController::class, 'deleteBrand']);
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', [BrandController::class, 'addEditBrand']);
        Route::get('delete-brand-image/{id}', [BrandController::class, 'deleteBrandImage']);
        Route::get('delete-brand-logo/{id}', [BrandController::class, 'deleteBrandLogo']);

        //banners
        Route::get('banners', [BannerController::class, 'banners']);
        Route::post('update-banner-status', [BannerController::class, 'updateBannerStatus']);
        Route::get('delete-banner/{id}', [BannerController::class, 'deleteBanner']);
        Route::match(['get', 'post'], 'add-edit-banner/{id?}', [BannerController::class, 'addEditBanner']);
    });
});

//Front
Route::namespace('App\Http\Controllers\Front')->group(function () {
    Route::get('/', [IndexController::class, 'index']);
});
