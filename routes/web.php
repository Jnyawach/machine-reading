<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'home'])->name('login')->middleware('guest');


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/machine-operator.php';
require __DIR__.'/supervisor.php';
