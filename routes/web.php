<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;

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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'permission'])->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'blank', 'as' => 'blank.'], function () {
        Route::get('/', function () {
            return view('sample.blank.index');
        })->name('index');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::patch('/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'product-category', 'as' => 'product-category.'], function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('create');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('store');
        Route::get('/edit/{product_category}', [ProductCategoryController::class, 'edit'])->name('edit');
        Route::patch('/update/{product_category}', [ProductCategoryController::class, 'update'])->name('update');
        Route::delete('/destroy/{product_category}', [ProductCategoryController::class, 'destroy'])->name('destroy');
    });
    
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::patch('update', [ProfileController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::patch('update/{permission}', [PermissionController::class, 'update'])->name('update');
            Route::post('assign-revoke', [PermissionController::class, 'assignRevoke'])->name('assign_revoke');
            Route::get('refresh', [PermissionController::class, 'refresh'])->name('refresh');
            Route::get('refresh-and-assign', [PermissionController::class, 'refreshAndAssign'])->name('refresh_and_assign');
            Route::delete('destroy/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::post('store', [RoleController::class, 'store'])->name('store');
            Route::patch('update/{role}', [RoleController::class, 'update'])->name('update');
            Route::delete('destroy/{role}', [RoleController::class, 'destroy'])->name('destroy');
        });
    });

});
