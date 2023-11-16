<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    // nếu muốn sửa gì thì phải vào đây rồi copy ném ra ngoài rồi sửa\
    use AuthenticatesUsers;

    // Dùng cả email và username

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // sau khi login thì check xem đã verify email hay chưa nếu chưa thì sẽ
    // redirect đến route('verification.notice') còn nếu đã verify rồi thì sẽ direct đến Home

// sau khi logout
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:6',
        ],[
            $this->username().'.required' => 'Please enter username or email',
            'password.required' => 'Please enter password',
        ]);
    }
    public function username()
    {
        return 'username';
    }
    protected function credentials(Request $request) // tên func là thông tin xác thực
    {
        // làm vậy để chấp nhận cả username và email login
        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $fieldDb = 'email';
        } else {
            $fieldDb = 'username';
        }
        $dataArr = [
            $fieldDb => $request->username,
            'password' => $request->password,
        ];
        return $dataArr;
    }
}
