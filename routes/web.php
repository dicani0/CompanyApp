<?php

use App\Http\Controllers\Administration\AdminDashboardController;
use App\Http\Controllers\Administration\UserController;
use App\Http\Controllers\Catering\CateringController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/catering/dashboard', [CateringController::class, 'dashboard'])->middleware('auth')->name('catering');

Route::get('/administration/dashboard', [AdminDashboardController::class, 'dashboard'])->middleware(['auth'])->name('administration-dashboard');

Route::get('/administration/users/trashed', [UserController::class, 'index'])->name('users.trashed');
Route::resource('/administration/users', UserController::class);
Route::get('/administration/users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
Route::get('/administration/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
Route::delete('/administration/users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');
