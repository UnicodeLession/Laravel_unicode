<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
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
// Dùng Controller
Route::get('/', [HomeController::class, 'index']);
Route::get('/news',
    'App\Http\Controllers\HomeController@getNews')->name('news');
Route::get('/products',
    'HomeController@getProducts')
    ->name('products');

