<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Doctors
use App\Http\Controllers\Doctors\IndexController;
use App\Http\Controllers\Doctors\Auth\LoginController;
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

// với middleware là verified thì bên db phía user phải có giá trị ở cột email_verified_at
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/products', function(){
        return 'Products';
    });
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


// Doctors
Route::prefix('doctors')->name('doctors.')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->middleware('auth:doctor')->name('index');
    // middleware('auth:guard_name') để check đăng nhập hay chưa?

    Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest:doctor')->name('login');
    // middleware('guest:guard_name') để check đăng nhập hay chưa?
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // logout: khi dùng GET thì có thể set url thành /doctors/logout và thực hiện logout được
    // khi dùng POST thì phải có form ẩn và sẽ thực hiện logout ở form đó
//    Route::get('/logout', function (){
//        Auth::guard('doctor')->logout();
//        return redirect()->route('doctors.login');
//    })->middleware('auth:doctor');
    Route::post('/logout', function (){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctors.login');
    })->middleware('auth:doctor')->name('logout');
});
