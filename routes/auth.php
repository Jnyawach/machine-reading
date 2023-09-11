<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedUser;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['guest']], function(){
    Route::post('auth/authenticate',[AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('register/creat/user',[AuthController::class, 'creatUser'])->name('create.user');
    Route::get('auth/register',[AuthController::class, 'register'])->name('register');
    Route::get('/auth/password-reset',[AuthController::class, 'reset'])->name('password-reset');
    Route::post('/auth/password-store',[AuthController::class, 'resetPassword'])->name('check.email');
    Route::get('/auth/reset-password', [AuthController::class, 'newPassword'])->name('create.password');
    Route::post('/auth/update-password', [AuthController::class, 'update'])->name('update.password');
});

Route::group(['middleware'=>['auth']], function (){
    Route::post('/auth/logout',[AuthenticatedUser::class, 'destroy'])->name('logout');
    Route::get('/auth/verify',[AuthenticatedUser::class, 'verify'])->name('verify');
    Route::post('/auth/password-new',[AuthenticatedUser::class, 'newPassword'])->name('new.password')->withoutMiddleware([UpdatePasswordMiddleware::class]);
    Route::get('/auth/password-update',[AuthenticatedUser::class, 'firstLogin'])->name('first.login')->withoutMiddleware([UpdatePasswordMiddleware::class]);
    Route::post('/auth/verified',[AuthenticatedUser::class, 'checkVerification'])->name('verified');
    Route::post('/auth/resend-link',[AuthenticatedUser::class, 'resendVerification'])->name('resend.link')->middleware('throttle:6,1');
    Route::get('/auth/authUser',[AuthenticatedUser::class, 'getAuthUser'])->name('auth.authUser');
    Route::get('/auth/refreshAuthSession',[AuthenticatedUser::class, 'refreshAuthSession'])->name('auth.refreshAuthSession');
    Route::get('/auth/edit-profile',[AuthenticatedUser::class, 'editProfile'])->name('auth.editProfile');
    Route::post('/auth/update-profile',[AuthenticatedUser::class, 'updateProfile'])->name('auth.updateProfile');
    Route::post('/auth/update-password',[AuthenticatedUser::class, 'updatePassword'])->name('auth.updatePassword');
});


