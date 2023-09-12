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
Route::get('/', function (){
    return view('welcome');
});
Route::get('product/{id}', function (string $id){
    return 'ID sản phẩm: '.$id;
    /**
     * nếu trong welcome.blade.php:
     * dùng route('san-pham', ['id'=>1]) thì không bắt buộc phải có ?
    */
})->name('san-pham');
Route::prefix('group')->group(function (){
    Route::get('add', function (){
        return 'thêm group';
    })->name('group.add') ;
});
