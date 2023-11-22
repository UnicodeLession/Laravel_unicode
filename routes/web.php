<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
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
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    echo $user->getAvatar() ."<br />";
    echo $user->getName() ."<br />";
    echo $user->getEmail();
});
