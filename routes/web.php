<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
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
// home blade template
Route::get('/', [HomeController::class, 'index']);
Route::get('san-pham', [HomeController::class, 'products']);

Route::get('/them-san-pham', [HomeController::class, 'getAdd']);
Route::post('/them-san-pham', [HomeController::class, 'postAdd']);
