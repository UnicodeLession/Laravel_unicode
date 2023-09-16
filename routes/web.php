<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\DashboardController;
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
// CategoryController
Route::prefix('categories')->group(function (){
    // Danh sách chuyên mục
    Route::get('/', [CategoriesController::class, 'index'])->name('categories.lists');
    // Lấy chi tiết 1 chuyên mục
    Route::get('/edit/{id}', [CategoriesController::class, 'getCategory'])->name('categories.edit');
    // xử lý update chuyên mục
    Route::post('/edit/{id}', [CategoriesController::class, 'updateCategory']);
    // Hiển thị form add dữ liệu
    Route::get('/add',  [CategoriesController::class, 'addCategory'])->name('categories.add');
    // xử lý thêm chuyên mục
    Route::post('/add', [CategoriesController::class, 'handleAddCategory']);
    // xóa chuyên mục
    Route::delete('/delete/{id}', [CategoriesController::class, 'deleteCategory'])->name('categories.delete');
});
//admin Route
Route::middleware('auth.admin')->prefix('admin')->group(function (){
    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('products', ProductsController::class);
});
// show props của Request
Route::get('request', [CategoriesController::class, 'showRequest']);
