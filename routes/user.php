<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserMachineController;
use App\Http\Controllers\User\UserReadingController;
use App\Http\Controllers\User\UserProductsController;
use App\Http\Controllers\User\UserShiftController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth','verified','update_password']], function (){
    Route::resource('user/machines',UserMachineController::class);
    Route::patch('user/readings/confirmed/{id}',[UserReadingController::class, 'markConfirmed'])->name('mark.reading.confirmed');
    Route::resource('user/readings',UserReadingController::class);
    Route::resource('user/products',UserProductsController::class);
    Route::resource('user/shifts',UserShiftController::class);
    Route::resource('user',UserController::class);
});
