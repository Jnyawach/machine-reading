<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserMachineController;
use App\Http\Controllers\User\UserReadingController;
use App\Http\Controllers\User\UserProductsController;
use App\Http\Controllers\User\UserShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified','update_password']], function (){
    Route::resource('user/machines',UserMachineController::class,['names'=>'user.machines']);
    Route::patch('user/readings/confirmed/{id}',[UserReadingController::class, 'markConfirmed'])->name('user.mark.reading.confirmed');
    Route::resource('user/readings',UserReadingController::class,['names'=>'user.readings']);
    Route::resource('user/products',UserProductsController::class,['names'=>'user.products']);
    Route::resource('user/shifts',UserShiftController::class,['names'=>'user.shifts']);
    Route::resource('user',UserController::class);
});
