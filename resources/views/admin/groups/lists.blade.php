@extends('layouts.admin')
@section('title', 'Danh Sách Người Dùng')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh Sách Nhóm</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div>
        @if(session('msg'))
            <div class="alert alert-{{session('type')}} text-center">
                {{session('msg')}}
            </div>
        @endif
    </div>
    <p><a href="{{route('admin.groups.add')}}" class="btn btn-primary btn-sm">Thêm mới</a></p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%" class="text-center">STT</th>
                <th>Tên</th>
                <th width="25%">Người Đăng</th>
                <th width="10%" class="text-center">Phân Quyền</th>
                <th width="5%" class="text-center">Sửa</th>
                <th width="5%" class="text-center">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if ($lists->count() > 0)
                @foreach($lists as $key=>$item)
                    <tr>
                        <td >{{$key + 1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{(!empty($item->postBy->name)) ? $item->postBy->name : false}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('admin.groups.permission', $item)}}}" class="btn btn-primary btn-sm">Phân Quyền</a>
                        </td>
                        <td >
                            <a href="{{route('admin.groups.edit',[$item->id] )}}" class="btn btn-warning btn-sm">Sửa</a>
                        </td>
                        <td>
                            <a href="{{route('admin.groups.delete', [$item->id])}} " onclick="return confirm('Bạn có chắc chắn muốn xóa nhóm này chứ?')" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-danger text-center">Không có nhóm</div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
