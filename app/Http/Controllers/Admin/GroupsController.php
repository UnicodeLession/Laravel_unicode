<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\User;
use App\Models\Modules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class GroupsController extends Controller
{
    //
    function index()
    {
        $lists = Groups::all();
        return view('admin.groups.lists', compact('lists'));
    }
    function add(){
        $users = User::all();
        return view('admin.groups.add', compact('users'));
    }
    function postAdd(Request $request){
        $request->validate([
            'name' =>'required|unique:groups,name',
        ]);
        $group = new Groups();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
        return redirect()->route('admin.groups.index')
            ->with('msg', 'Thêm Nhóm Thành Công!')
            ->with('type', 'success');
    }
    function edit(Groups $group){
        return view('admin.groups.edit', compact('group'));
    }
    function postEdit(Groups $group, Request $request){
        $request->validate([
            'name' =>'required|unique:groups,name',
        ]);
        $group->name = $request->name;
        $group->update();
        return back()
            ->with('msg', 'Cập Nhật Tên Nhóm Thành Công!')
            ->with('type', 'success');
    }
    function delete(Groups $group){
        $userCount = $group->users()->count();
        if ($userCount == 0) {
            Groups::destroy($group->id);
            return redirect()->route('admin.groups.index')
                ->with('msg', 'Bạn Xóa Nhóm Thành Công!')
                ->with('type', 'success');
        }
        return redirect()->route('admin.groups.index')
            ->with('msg', 'Bạn Không Thể Xóa Nhóm Do Trong Nhóm Đang Có'.$userCount.' Người Dùng!')
            ->with('type', 'danger');
    }

    function permission(Groups $group)
    {
        $modules = Modules::all();
        $roleListArray = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];
        // lấy ra Role để check sẵn những checkbox đã lưu ở db
        $roleJson = $group->permissions;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
        }else{
            $roleArr = [];
        }
        return view('admin.groups.permission',
            compact(
                'group',
                'roleListArray',
                'modules',
                'roleArr'
            ));
    }

    function postPermission(Groups $group, Request $request)
    {
        if (!empty($request->role)){
            $roleArr = $request->role;
        }else{
            $roleArr = [];
        }
        $roleJson = json_encode($roleArr);
        $group->permissions = $roleJson;
        $group->update();
        return back()->with('msg', 'Phân Quyền Thành Công!')->with('type', 'success');
    }
}
