<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\controllers\Front\PagesController;
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

Auth::routes();

// User Routess
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services']);
Route::get('/transactions', [App\Http\Controllers\HomeController::class, 'transactions']);
Route::get('/help', [App\Http\Controllers\HomeController::class, 'help']);
Route::get('/settings', [App\Http\Controllers\HomeController::class, 'settings']);

// Admin Routes
Route::prefix('admin')->middleware('auth', 'isAdmin')->group( function() {
    Route::get('/index', [AdminController::class, 'index']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/settings', [AdminController::class, 'get_settings']);
    Route::post('/settings', [AdminController::class, 'update_settings']);
});