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

Route::prefix('/group')->group(function (){
    Route::view('/', 'welcome', ['name'=>'render welcome blade template trong group']);
    Route::get('/add', function (){
        return 'đã truy cập vào /group/add';
    });
});
