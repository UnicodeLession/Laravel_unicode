<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Users;
class UsersController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();

    }

    function index()
    {
        $title = "Danh Sách Người Dùng";
        $usersList = $this->users->getAllUsers();
        return view('clients.users.lists', compact('title', 'usersList'));
    }

    function add()
    {
        $title = 'Thêm Người Dùng';
        return view('clients.users.add', compact('title'));

    }

    function postAdd(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ],[
            'name.required' => 'Họ Và Tên Bắt Buộc Phải Nhập',
            'name.min' => 'Vui Lòng Điền Đầy Đủ Họ Và Tên',
            'email.required' => 'Email Bắt Buộc Phải Nhập',
            'email.email' => 'Email Không Chính Xác',
            'email.unique' => 'Email Đã Tồn Tại Trên Hệ Thống',
        ]);
        $dataInsert = [
             $request->name,
            $request->email,
             date('Y-m-d H:i:s')
        ];
        $this->users->addUser($dataInsert);
        return redirect(route('users.index'))->with('msg', 'Thêm người dùng thành công');
    }
}
