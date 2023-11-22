<?php

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

/**
 * Mỗi chỉnh sửa gì xong thì phải làm theo 3 bước dưới
        git add .
        git commit -am "make it better"
        git push heroku master
*/

Route::get('/', function () {
    return view('welcome');
});
