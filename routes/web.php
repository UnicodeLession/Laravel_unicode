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
})->name('home');
Route::prefix('group')->middleware('checkadminlogin')->group(function (){
    Route::get('add', function (){
        return 'thêm group';
    })->name('group.add') ;
    /**
     * khi dùng return redirect(route('home')) thì khi truy cập bất cứ cái nào trong group thì sẽ redirect đến route('home')
     * http://localhost:8000/group/add thì lúc đó sẽ truy cập vào http://localhost:8000/
    */
});
