<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

/**
 * ! Với Nhiều Requests
 * ! Route::match([requests], '/match', function (){});
 */
Route::match(['get', 'post'], 'requests', function (){
   return $_SERVER['REQUEST_METHOD'];
});
Route::get('show_form', function (){
  return view('form');
});
/**
 * khi đó ta truy cập vào http://localhost:8000/requests sẽ render ra GET
 * mà khi truy cập vào show_form rồi submit thì khi chuyển qua trang http://localhost:8000/requests sẽ render ra POST
*/
/**
 * ! Với trang dùng tất cả request thì sẽ dùng any
 * ! Route::any('/any', function (){});
 * * để thử hãy change value của input _method rồi vào http://localhost:8000/show_form rồi ấn vào gửi rồi sẽ show method
*/
Route::any('/any', function (Request $request){
    return $request->method();
});
Route::get('show_form', function (){
    return view('form');
});

/**
 * ! Dùng redirect
 * ! Route::redirect('redirect-from', 'redirect-to', status-code=301)
 * 
*/
Route::redirect('about-us', 'about');
