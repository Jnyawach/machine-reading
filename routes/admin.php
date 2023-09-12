<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMachineController;
use App\Http\Controllers\Admin\AdminReadingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProducts;
use App\Http\Controllers\Admin\AdminShiftController;
use App\Http\Controllers\Admin\AdminRolesController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified','update_password','role:Admin']], function (){
    Route::get('admin/machines/report/{format}',[AdminMachineController::class,'report'])->name('admin.machines.report');
    Route::resource('admin/machines',AdminMachineController::class);
    Route::patch('admin/readings/confirmed/{id}',[AdminReadingController::class, 'markConfirmed'])->name('mark.reading.confirmed');
    Route::get('admin/readings/report/{format}',[AdminReadingController::class,'report'])->name('admin.readings.report');
    Route::resource('admin/readings',AdminReadingController::class);
    Route::get('admin/products/report/{format}',[AdminProducts::class,'report'])->name('admin.products.report');
    Route::resource('admin/products',AdminProducts::class);
    Route::get('admin/shifts/report/{format}',[AdminShiftController::class,'report'])->name('admin.shifts.report');
    Route::resource('admin/shifts',AdminShiftController::class);
    Route::get('admin/users/report/{format}',[AdminUserController::class,'report'])->name('admin.users.report');
    Route::resource('admin/users',AdminUserController::class,['names' => 'admin.users']);
    Route::post('admin/roles/permission',[AdminRolesController::class, 'permission'])->name('admin.roles.permission');
    Route::resource('admin/roles',AdminRolesController::class,['names' => 'admin.roles']);
    Route::resource('admin',AdminController::class);
});
