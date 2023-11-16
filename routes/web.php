<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/products', function(){
        return 'Products';
    });
}); // middleware phải ở sau prefix, khi truy cập vào bất cứ route bên trong admin phải đăng nhập k thì nó sẽ đẩy đến trang đăng nhập
//Route::get('/', [AdminController::class, 'index'])->middleware('auth'); // khi có middleware thì nếu k đăng nhập sẽ không truy cập vào được
//Route::get('/admin', [AdminController::class, 'index']); // không có middleware bên route thì bên __construct() function bên Controller nên có middleware nếu cần
