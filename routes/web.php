<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PermissionController;

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

// Route::get('route', function (){
//     $routeCollection = Route::getRoutes();
//     $ignore_route = [
//         'ignition',
//         'login',
//         'logout',
//         'register',
//         'password',
//     ];

//     foreach ($routeCollection as $value) {
//         if(strConInArray($ignore_route, $value->getName()) && $value->getName() != null){
//             dump($value->getName());
//         }
//     }
// });

// function strConInArray($array, $check)
// {
//     foreach($array as $arr){
//         if(stripos($check, $arr) !== false){
//             return false;
//         }
//     }
//     return true;
// }


Route::middleware(['auth', 'permission'])->group(function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/', function () {
            return view('sample.profile.index');
        })->name('index');
    });

    Route::group(['prefix' => 'blank', 'as' => 'blank.'], function () {
        Route::get('/', function () {
            return view('sample.blank.index');
        })->name('index');
    });

    Route::group(['prefix' => 'permission', 'as' => 'permission.'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('create', [PermissionController::class, 'create'])->name('create');
        Route::get('edit/{permission}', [PermissionController::class, 'edit'])->name('edit');
        Route::patch('update/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::post('assign-revoke', [PermissionController::class, 'assignRevoke'])->name('assign_revoke');
        Route::get('refresh', [PermissionController::class, 'refresh'])->name('refresh');
        Route::get('refresh-and-assign', [PermissionController::class, 'refreshAndAssign'])->name('refresh_and_assign');
    });

});
