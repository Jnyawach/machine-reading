<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMachineController;
use App\Http\Controllers\Admin\AdminReadingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProducts;
use App\Http\Controllers\Admin\AdminShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified','update_password','role:Admin']], function (){
    Route::resource('admin/machines',AdminMachineController::class);
    Route::patch('admin/readings/confirmed/{id}',[AdminReadingController::class, 'markConfirmed'])->name('mark.reading.confirmed');
    Route::resource('admin/readings',AdminReadingController::class);
    Route::resource('admin/products',AdminProducts::class);
    Route::resource('admin/shifts',AdminShiftController::class);
    Route::resource('admin/users',AdminUserController::class,['names' => 'admin.users']);
    Route::resource('admin',AdminController::class);
});
