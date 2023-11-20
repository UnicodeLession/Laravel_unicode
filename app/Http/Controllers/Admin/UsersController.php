<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    function index()
    {
        $lists = User::all();
        return view('admin.users.lists', compact('lists'));
    }
    function add(){
        $groups = Groups::all();
        return view('admin.users.add', compact('groups'));
    }

    function postAdd(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users,email',
            'password' =>'required',
            'group_id' => ['required', function($attribute, $value, $fail) use ($request){
                if ($value ==0){
                    $fail('Please choose your group!'); // trong select sẽ có value = 0 thì với Closure này sẽ giúp hiển lỗi khi value trong select bằng 0
                }
            }]
        ],[
            'name.required' =>'Please enter your name',
            'email.required' =>'Please enter your email',
            'password.required' => 'Please enter your password',
            'email.email' => 'Email Invalid',
            'email.unique' => 'The email has already been used',
            'group_id.required' => 'Please choose your group'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        //đây là người đã tạo ra tài khoản. ví dụ khi đăng nhập với id = 1 và tạo mới id = 9 thì id=9 đó sẽ có user_id = 1
        $user->save();
        return redirect()->route('admin.users.index')
            ->with('msg', 'Thêm Người Dùng Thành Công!')
            ->with('type', 'success');
    }
    function edit(User $user)
    {
        return view('admin.users.edit');
    }
    function postEdit(User $user){

    }
    function delete(User $user){

    }
}
