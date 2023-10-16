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
        ], [
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

    function getEdit(Request $request,$id = 0)
    {
        $title = 'Cập Nhật Người Dùng';
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail[0])) {

                $request->session()->put('id', $id);

                $userDetail = $userDetail[0];
            };
        } else {
            return redirect()->route('users.index')
                ->with('msg', 'Người Dùng Không Tồn Tại')
                ->with('type', 'danger');
        }
        return view('clients.users.edit', compact('title', 'userDetail'));
    }

    function postEdit(Request $request)
    {
        $id = session('id');
        if(empty($id)) {
            return back()->with('msg', 'Liên Kết Không Tồn Tại')->with('type', 'danger');
        }
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users,email,'.$id,
        ], [
            'name.required' => 'Họ Và Tên Bắt Buộc Phải Nhập',
            'name.min' => 'Vui Lòng Điền Đầy Đủ Họ Và Tên',
            'email.required' => 'Email Bắt Buộc Phải Nhập',
            'email.email' => 'Email Không Chính Xác',
             'email.unique' => 'Email Đã Tồn Tại Trên Hệ Thống', // sửa nhưng tránh trùng với email của người khác
        ]);
        $dataUpdate = [
            $request->name,
            $request->email,
            date('Y-m-d H:i:s')
        ];
        $this->users->updateUser($dataUpdate, $id);
        return back()
            ->with('msg', 'Cập Nhật Thông Tin Người Dùng Thành Công')
            ->with('type', 'success')
            ->withInput();
        // redirect()->route('users.index', ['id'=>$id]) = back()
    }
}
