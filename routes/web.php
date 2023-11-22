<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
//Admin
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\GroupsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
//Model
use App\Models\Post;
use App\Models\Group;
use App\Models\User;
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
    return view('welcome');
});

// Email Verify khi phải login với middleware có 'auth'
// link thông báo verify khi người người đăng ký tài khoản, chưa xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// link liên kết sẽ được gửi vào emauil của người đăng ký
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// xử lý hành động gửi lại email
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Quản Lý Bài Viết
    Route::prefix('posts')->name('posts.')->middleware('can:posts')->group(function () {
        Route::get('/', [PostsController::class, 'index'])
            ->name('index');
        Route::get('/add', [PostsController::class, 'add'])
            ->name('add')
            ->can('create', Post::class);
        Route::post('/add', [PostsController::class, 'postAdd'])
            ->can('create', Post::class);
        Route::get('/edit/{post}', [PostsController::class, 'edit'])
            ->name('edit')
            ->can('posts.edit');
        Route::post('/edit/{post}', [PostsController::class, 'postEdit'])
            ->can('posts.edit');
        Route::get('/delete/{post}', [PostsController::class, 'delete'])
            ->name('delete')
            ->can('posts.delete');
    });

    // Quản Lý Groups
    Route::prefix('groups')->name('groups.')->middleware('can:groups')->group(function () {
        Route::get('/', [GroupsController::class, 'index'])->name('index');
        Route::get('/add', [GroupsController::class, 'add'])
            ->name('add')
            ->can('create', Group::class);
        Route::post('/add', [GroupsController::class, 'postAdd'])
            ->can('create', Group::class);
        Route::get('/edit/{group}', [GroupsController::class, 'edit'])
            ->name('edit')
            ->can('groups.edit');
        Route::post('/edit/{group}', [GroupsController::class, 'postEdit'])
            ->can('groups.edit');
        Route::get('/delete/{group}', [GroupsController::class, 'delete'])
            ->name('delete')
            ->can('groups.delete');
        Route::get('/permission/{group}', [GroupsController::class, 'permission'])->name('permission');
        Route::post('/permission/{group}', [GroupsController::class, 'postPermission']);
    });

    // Quản Lý Users
    Route::prefix('users')->name('users.')->middleware('can:users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/add', [UsersController::class, 'add'])
            ->name('add')
            ->can('create', User::class);
        Route::post('/add', [UsersController::class, 'postAdd'])
            ->can('create', User::class);
        Route::get('/edit/{user}', [UsersController::class, 'edit'])
            ->name('edit')
            ->can('users.edit');
        Route::post('/edit/{user}', [UsersController::class, 'postEdit'])
            ->can('users.edit');
        Route::get('/delete/{user}', [UsersController::class, 'delete'])
            ->name('delete')
            ->can('users.delete');
    });
});
