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

Route::get('/', function () {
    return view('form');
});
// khi đó khi truy cập vào http://localhost:8000/ thì sẽ render file \resources\views\welcome.blade.php
/**
 * ! Route::request('url', callbackFuntion() {})
*/
Route::post('/', function () {
   return 'Đã xong với phương thức post';
});
/**
 * khi đó ta truy cập vào http://localhost:8000/ thì nó sẽ render ra form để nhập input
 * khi nhập xong form và gửi thì nó sẽ render ra "Đã xong với phương thức post"
 */

