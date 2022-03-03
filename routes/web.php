<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::prefix('/')->middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix'=>'user'],function(){
        Route::get('/', [UserController::class, 'index'])->name('user');
    });


    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('role');//->middleware('permission:view.roles');
        Route::get('/create', [RoleController::class, 'create'])->name('role.create');//->middleware('permission:create.roles');
        Route::post('/store', [RoleController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');//->middleware('permission:edit.roles');
        Route::put('update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('role.delete');//->middleware('permission:destroy.roles');
        Route::get('/activeinactive/{type}/{id}', [RoleController::class, 'activeinactive']);//->name('role.activeinactive')->middleware('permission:activeinactive.roles');
        Route::get('/getRoleData', [RoleController::class, 'getRoleData'])->name('role.getRoleData');
        Route::post('/checkRole', [RoleController::class, 'checkRole'])->name('role.checkRole');
    });

});
