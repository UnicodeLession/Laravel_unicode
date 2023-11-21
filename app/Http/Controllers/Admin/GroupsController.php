<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\User;
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
}
