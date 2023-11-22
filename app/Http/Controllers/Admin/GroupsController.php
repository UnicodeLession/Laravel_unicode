<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
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
        $group = new Group();
        /**
         * Note:
         * Người của Group Admin có khi đc phân quyền edit or delete thì tất cả thành viên bên trong có quyền tác động tới tất cả các group khác bao gồm group Admin
         * group admin thì nên để sẵn tất cả các quyền view, edit, delete, permission

         * change: view, edit, delete, permission
         * người không thuộc group Admin thì chỉ có thể change group mình tạo ra
         */
        $adminGroupId = Group::where('name', 'Administrator')->first()->id;
        $can = Auth::user()->group_id === $adminGroupId;
        $canChange = Group::where('user_id', Auth::user()->id)->get();
        $others = Group::where('user_id','<>', Auth::user()->id)->get();
        return view('admin.groups.lists', compact('canChange', 'others'));
    }
    function add(){
        $users = User::all();
        return view('admin.groups.add', compact('users'));
    }
    function postAdd(Request $request){
        $request->validate([
            'name' =>'required|unique:groups,name',
        ]);
        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();
        return redirect()->route('admin.groups.index')
            ->with('msg', 'Thêm Nhóm Thành Công!')
            ->with('type', 'success');
    }
    function edit(Group $group){
        $this->authorize('update', $group);
        return view('admin.groups.edit', compact('group'));
    }
    function postEdit(Group $group, Request $request){
        $this->authorize('update', $group);
        $request->validate([
            'name' =>'required|unique:groups,name',
        ]);
        $group->name = $request->name;
        $group->update();
        return back()
            ->with('msg', 'Cập Nhật Tên Nhóm Thành Công!')
            ->with('type', 'success');
    }
    function delete(Group $group){
        $this->authorize('delete', $group);
        $userCount = $group->users()->count();
        if ($userCount == 0) {
            Group::destroy($group->id);
            return redirect()->route('admin.groups.index')
                ->with('msg', 'Bạn Xóa Nhóm Thành Công!')
                ->with('type', 'success');
        }
        return redirect()->route('admin.groups.index')
            ->with('msg', 'Bạn Không Thể Xóa Nhóm Do Trong Nhóm Đang Có'.$userCount.' Người Dùng!')
            ->with('type', 'danger');
    }

    function permission(Group $group)
    {
        $this->authorize('permission', $group);
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

    function postPermission(Group $group, Request $request)
    {
        $this->authorize('permission', $group);
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
