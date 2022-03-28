<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerGroupController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::get('/verifyOtp/{id}', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
Route::post('/checkOtp/{id}', [LoginController::class, 'checkOtp'])->name('checkOtp');


Route::prefix('/')->middleware(['auth', 'CheckRoleStatus'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /* Routes For User */
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user')->middleware('permission:view.users');
        Route::get('/getUserData', [UserController::class, 'getUserData'])->name('getUserData');
        Route::get('/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:create.users');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/view/{id}', [UserController::class, 'view'])->name('user.view')->middleware('permission:view.users');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:edit.users');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete')->middleware('permission:delete.users');
        Route::get('/activeInactive/{id}', [UserController::class, 'activeInactive'])->name('user.activeInactive')->middleware('permission:activeinactive.users');
        Route::post('/checkEmail', [UserController::class, 'checkEmail'])->name('user.checkEmail');
    });

    /* Routes For Role */
    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role')->middleware('permission:view.roles');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:create.roles');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:edit.roles');
        Route::put('/update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete')->middleware('permission:delete.roles');
        Route::get('/activeinactive/{type}/{id}', [RoleController::class, 'activeinactive'])->name('role.activeinactive')->middleware('permission:activeinactive.roles');
        Route::get('/getRoleData', [RoleController::class, 'getRoleData'])->name('role.getRoleData');
        Route::post('/checkRole', [RoleController::class, 'checkRole'])->name('role.checkRole');
    });

    /** Routes For category */
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category')->middleware('permission:view.category');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create')->middleware('permission:create.category');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store')->middleware('permission:create.category');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('permission:edit.category');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware('permission:edit.category');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware('permission:delete.category');
        Route::get('/activeinactive/{type}/{id}', [CategoryController::class, 'activeinactive'])->name('category.activeinactive')->middleware('permission:activeinactive.category');
        Route::get('/getCategoryData', [CategoryController::class, 'getCategoryData'])->name('category.getCategoryData')->middleware('permission:view.category');
        Route::post('/checkCategoryName', [CategoryController::class, 'checkCategoryName'])->name('category.checkCategoryName')->middleware('permission:view.category');
        Route::post('/checkCategoryCode', [CategoryController::class, 'checkCategoryCode'])->name('category.checkCategoryCode')->middleware('permission:view.category');
    });

    /* Routes For Setting */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('/update', [SettingController::class, 'update'])->name('settings.update');
    });

    /** Routes For customer group */
    Route::group(['prefix' => 'customerGroup'], function () {
        Route::get('/', [CustomerGroupController::class, 'index'])->name('customerGroup')->middleware('permission:view.customerGroup');
        Route::get('/create', [CustomerGroupController::class, 'create'])->name('customerGroup.create')->middleware('permission:create.customerGroup');
        Route::post('/store', [CustomerGroupController::class, 'store'])->name('customerGroup.store')->middleware('permission:create.customerGroup');
        Route::get('/edit/{id}', [CustomerGroupController::class, 'edit'])->name('customerGroup.edit')->middleware('permission:edit.customerGroup');
        Route::put('/update/{id}', [CustomerGroupController::class, 'update'])->name('customerGroup.update')->middleware('permission:edit.customerGroup');
        Route::get('/delete/{id}', [CustomerGroupController::class, 'delete'])->name('customerGroup.delete')->middleware('permission:delete.customerGroup');
        Route::get('/activeinactive/{type}/{id}', [CustomerGroupController::class, 'activeinactive'])->name('customerGroup.activeinactive')->middleware('permission:activeinactive.customerGroup');
        Route::get('/getCustomerGroupData', [CustomerGroupController::class, 'getCustomerGroupData'])->name('customerGroup.getCustomerGroupData')->middleware('permission:view.customerGroup');
        Route::post('/checkCustomerGroupName', [CustomerGroupController::class, 'checkCustomerGroupName'])->name('customerGroup.checkCustomerGroupName')->middleware('permission:view.customerGroup');
    });

});




Route::get('importExportView', [ArticleController::class,'importExportView']);

Route::get('export', [ArticleController::class,'export'])->name('export');

Route::post('import', [ArticleController::class,'import'])->name('import');