<?php

namespace App\Http\Controllers\Doctors\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    protected function validateEmail(Request $request)
    {
        $request->validate(
            ['email' => 'required|email'],
            [
                'email.required' => 'Please enter email',
                'email.email' => 'Incorrect email format.'
            ]
        );
    }
    public function showLinkRequestForm()
    {
        return view('doctors.auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        dd($request);
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        // Để lưu trữ thông tin token reset password, Laravel sử dụng bảng "password_resets". Bảng này có hai trường là "email" và "token", lưu trữ email của người dùng cần reset password và token được tạo ra để xác nhận yêu cầu reset password.
        // Tuy nhiên, trong trường hợp bạn có nhiều guard khác nhau và muốn sử dụng chức năng reset password cho mỗi guard, Laravel vẫn sử dụng cùng một bảng "password_resets" để lưu trữ thông tin token reset password.
        // Điều này có nghĩa là khi bạn gửi yêu cầu reset password cho một email bất kỳ trong guard "doctors", Laravel sẽ kiểm tra email đó có tồn tại trong bảng "doctors" hay không.
        // Nếu không tìm thấy, Laravel sẽ tiếp tục kiểm tra trong bảng "users". Nếu email đó tồn tại trong bảng "users", Laravel vẫn sẽ tạo ra token reset password và gửi đường link reset password đến email của người dùng.

        // Có lỗi chưa fix phải check xem cái email đó có trong table doctors hay không rồi mới tạo request
        $check = DB::table('doctors')->where('email', $request->email)->first();
        if ($check){
            $response = $this->broker()->sendResetLink(
                $this->credentials($request)
            );
            return $response == Password::RESET_LINK_SENT
                ? $this->sendResetLinkResponse($request, $response)
                : $this->sendResetLinkFailedResponse($request, $response);
        }
        // Email không tồn tại trong bảng "doctors", trả về thông báo lỗi
        return back()->withErrors(['email' => trans('passwords.user')]);
    }
    public function broker()
    {
        return Password::broker('doctors');
    }
}
