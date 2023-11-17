<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    // show login form
    public function showLoginForm()
    {
        return view('doctors.auth.login');
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string',
        ]);
    }
    public function login(Request $request)
    {
        $this->validateLogin($request); // validate login
        $dataLogin = $request->except(['_token']);
        if(isDoctorActive($dataLogin['email'])){
            $checkLogin = Auth::guard('doctor')->attempt($dataLogin);
            if($checkLogin){
                return redirect(RouteServiceProvider::DOCTOR);
            } else {
                return back()->with('msg', 'Email or Password incorrect!')->with('type', 'danger');
            }
        }
        return back()->with('msg', 'The account has not been activated!')->with('type', 'danger');
    }
}
