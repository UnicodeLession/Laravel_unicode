@extends('layouts.admin')
@section('title', 'Phân Quyền Nhóm')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Phân Quyền Nhóm {{$group->name}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
        @if($errors->any())
            <div class="alert-danger alert text-center">Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
        @endif
    </div>
    <form action="" method="post">
        @csrf
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="20%">Module</th>
                <th>Quyền</th>
            </tr>
            </thead>
            <tbody>
            @if($modules->count() > 0 )
                @foreach($modules as $module)
                    <tr>
                        <td>{{$module->title}}</td>
                        <td>
                            <div class="row">
                                @if(!empty($roleListArray))
                                    @foreach($roleListArray as $roleName => $roleLabel)
{{--                                        rảnh thử nếu checkbox thêm sửa hoặc xóa mà k check xem thì checkbox của xem tự động hiện lên bỏi vì phải xem đc mới làm đc các cái khác--}}
                                        <div class="col-2">
                                            <label for="role_{{$module->name}}_{{$roleName}}">
                                                <input
                                                    type="checkbox"
                                                    name="role[{{$module->name}}][]"
                                                    id=""
                                                    value="{{$roleName}}"
                                                    {{isRole($roleArr, $module->name, $roleName) ? 'checked' : false}}
                                                />
                                                {{$roleLabel}}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                                @if($module->name == 'groups')
                                    <div class="col-4">
                                        <label for="role_{{$module->name}}_permission">
                                            <input
                                                type="checkbox"
                                                name="role[{{$module->name}}][]"
                                                id=""
                                                value="permission"
                                                {{isRole($roleArr, $module->name, 'permission') ? 'checked' : false}}
                                            />
                                            Phân Quyền
                                        </label>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary btn-sm">Phân Quyền</button>
    </form>
    <hr>
@endsection
