<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
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
        $groups = Group::all();
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
            'email.unique' => 'The name has already been taken',
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
        $groups = Group::all();
        return view('admin.users.edit', compact('groups', 'user'));
    }
    function postEdit(User $user, Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users,email,'.$user->id, // tránh báo lỗi khi trùng với chính nó
            'group_id' => ['required', function($attribute, $value, $fail) use ($request){
                if ($value ==0){
                    $fail('Please choose your group!'); // trong select sẽ có value = 0 thì với Closure này sẽ giúp hiển lỗi khi value trong select bằng 0
                }
            }]
        ],[
            'name.required' =>'Please enter your name',
            'email.required' =>'Please enter your email',
            'email.email' => 'Email Invalid',
            'email.unique' => 'The email has already been used',
            'group_id.required' => 'Please choose your group'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if (!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id;
        $user->update();
        return back()
            ->with('msg', 'Cập Nhật Người Dùng Thành Công!')
            ->with('type', 'success');
    }
    function delete(User $user){
        if (Auth::user()->id!==$user->id){
            // xử lý xóa
            User::destroy($user->id);
            return redirect()->route('admin.users.index')
                ->with('msg', 'Bạn Xóa Tài Khoản Thành Công!')
                ->with('type', 'success');
        }
        return redirect()->route('admin.users.index')
                ->with('msg', 'Bạn Không Thể Xóa Tài Khoản Đang Đăng Nhập!')
                ->with('type', 'danger');
    }
}