<?php

use App\Http\Controllers\Administration\AdminDashboardController;
use App\Http\Controllers\Administration\FundingController;
use App\Http\Controllers\Administration\SupplierController;
use App\Http\Controllers\Administration\UserController;
use App\Http\Controllers\Catering\CartController;
use App\Http\Controllers\Catering\CateringController;
use App\Http\Controllers\Catering\DishController;
use App\Http\Controllers\Catering\OrderController;
use App\Http\Middleware\isUsersCart;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', function () {
        return view('home');
    });

    Route::get('/cart/add/{dish}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/catering', [CateringController::class, 'dashboard'])->name('catering');

    Route::get('/catering/menu/{supplier}', [DishController::class, 'allSupplierDishes'])->name('dishes');
    Route::get('/catering/menu/{supplier}/add', [DishController::class, 'create'])->name('dish.create');
    Route::post('/catering/menu/{supplier}/store', [DishController::class, 'store'])->name('dishes.store');

    Route::get('/catering/order/{cart}/create', [OrderController::class, 'create'])->name('order.create')->middleware(isUsersCart::class);
    Route::get('/catering/order/history', [OrderController::class, 'getUserOrders'])->name('order.history');
    Route::get('/catering/order/{id}', [OrderController::class, 'getOrder'])->name('order.get');
});

Route::group(['middleware' => ['auth', 'isUsersOrder']], function () {
    Route::get('/catering/order/{order}/delete', [OrderController::class, 'destroy'])->name('order.delete');
    Route::get('/catering/order/{order}/finalize', [OrderController::class, 'finalize'])->name('order.finalize');
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/administration/dashboard', [AdminDashboardController::class, 'dashboard'])->name('administration-dashboard');

    Route::get('/administration/users/trashed', [UserController::class, 'index'])->name('users.trashed');
    Route::resource('/administration/users', UserController::class);
    Route::get('/administration/users/{user}/verify', [UserController::class, 'verify'])->name('users.verify');
    Route::get('/administration/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/administration/users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.force-delete');

    Route::resource('/administration/suppliers', SupplierController::class);

    Route::get('/administration/fundings/{id}/clear', [FundingController::class, 'clearUserFunding'])->name('fundings.clear');
    Route::get('/administration/fundings/{id}/renew', [FundingController::class, 'renewUserFunding'])->name('fundings.renew.one');
    Route::get('/administration/fundings/renew', [FundingController::class, 'renewAllFundings'])->name('fundings.renew');
    Route::resource('/administration/fundings', FundingController::class);
});
