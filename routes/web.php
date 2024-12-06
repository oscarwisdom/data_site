<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\controllers\Front\PagesController;
use App\Http\Controllers\VTUController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PagesController::class, "index"]);
Route::get('/about', [PagesController::class, 'about']);
Route::get('/how', [PagesController::class, 'how_it_works']);
Route::get('/features', [PagesController::class, 'features']);

Auth::routes();

// User Routess
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/payment', [App\Http\Controllers\HomeController::class, 'payment']);
Route::get('/make_payment', [App\Http\Controllers\HomeController::class, 'make_payment']);
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services']);
Route::get('/transactions', [App\Http\Controllers\HomeController::class, 'transactions']);
Route::get('/help', [App\Http\Controllers\HomeController::class, 'help']);
Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings']);

// VTU Routes
Route::post('/buy-airtime', [VTUController::class, 'buy_airtime']);

Route::get('/buy_item/{item}', [App\Http\Controllers\Front\BuyItemController::class, 'buy_item']);

// service Route added by me
Route::get('/nin', [App\Http\Controllers\HomeController::class, 'nin']);
Route::get('/tin', [App\Http\Controllers\HomeController::class, 'tin']);
Route::get('/mobile_data', [App\Http\Controllers\HomeController::class, 'mobile_data']);
Route::get('/sme', [App\Http\Controllers\HomeController::class, 'sme']);
Route::get('/electricity', [App\Http\Controllers\HomeController::class, 'electricity']);
Route::get('/bills', [App\Http\Controllers\HomeController::class, 'bills']);


// Admin Routes
Route::prefix('admin')->middleware('auth', 'isAdmin')->group( function() {
    Route::get('/index', [AdminController::class, 'index']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/settings', [AdminController::class, 'get_settings']);
    Route::post('/settings', [AdminController::class, 'update_settings']);
});
