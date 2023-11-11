<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostController;
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
Route::get('san-pham', [HomeController::class, 'products'])->name('product');

Route::get('/them-san-pham', [HomeController::class, 'getAdd']);
Route::post('/them-san-pham', [HomeController::class, 'postAdd']);
// Người dùng
Route::prefix('users')->name('users.')->group(function (){
    Route::get('/', [UsersController::class, 'index'])->name('index');

    Route::get('/add', [UsersController::class, 'add'])->name('add');
    Route::post('/add', [UsersController::class, 'postAdd'])->name('post-add');

    Route::get('/edit/{id}', [UsersController::class, 'getEdit'])->name('edit');
    Route::post('/update', [UsersController::class, 'postEdit'])->name('post-edit');

    Route::get('/delete/{id}', [UsersController::class, 'delete'])->name('delete');

    Route::get('/one-one', [UsersController::class, 'oneOne']);
    Route::get('/one-many', [UsersController::class, 'oneMany']);
});
Route::prefix('posts')->name('posts.')->group(function (){
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/add', [PostController::class, 'add'])->name('add');
    Route::get('/update/{id}', [PostController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
    Route::post('/delete-any', [PostController::class, 'handleDeleteAny'])->name('delete-any');
    Route::get('/restore/{id}', [PostController::class, 'restore'])->name('restore');
    Route::get('/force-delete/{id}', [PostController::class, 'forceDelete'])->name('force-delete');

});
