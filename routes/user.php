<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserMachineController;
use App\Http\Controllers\User\UserReadingController;
use App\Http\Controllers\User\UserProductsController;
use App\Http\Controllers\User\UserShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified','update_password']], function (){
    Route::get('user/machines/report/{format}',[UserMachineController::class,'report'])->name('user.machines.report');
    Route::resource('user/machines',UserMachineController::class,['names'=>'user.machines']);
    Route::patch('user/readings/confirmed/{id}',[UserReadingController::class, 'markConfirmed'])->name('user.mark.reading.confirmed');
    Route::get('user/readings/report/{format}',[UserReadingController::class,'report'])->name('user.readings.report');
    Route::resource('user/readings',UserReadingController::class,['names'=>'user.readings']);
    Route::get('user/products/report/{format}',[UserProductsController::class,'report'])->name('user.products.report');
    Route::resource('user/products',UserProductsController::class,['names'=>'user.products']);
    Route::get('user/shifts/report/{format}',[UserShiftController::class,'report'])->name('user.shifts.report');
    Route::resource('user/shifts',UserShiftController::class,['names'=>'user.shifts']);
    Route::resource('user',UserController::class);
});
