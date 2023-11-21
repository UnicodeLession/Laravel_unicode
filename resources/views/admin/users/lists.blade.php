@extends('layouts.admin')
@section('title', 'Danh Sách Người Dùng')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh Sách Người Dùng</h1>
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
    @can('create', App\Models\User::class)
    <p><a href="{{route('admin.users.add')}}" class="btn btn-primary btn-sm">Thêm mới</a></p>
    @endcan
    @if($usersChange->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="30%">Tên</th>
                <th width="35%">Email</th>
                <th width="20&">Nhóm</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
            </thead>
            <tbody>
                @foreach($usersChange as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->group->name}}</td>
                        <td>
                            <a href="{{route('admin.users.edit',[$item->id] )}}"
                               class="btn btn-warning btn-sm @cannot('users.edit') disabled @endcannot"
                            >Sửa</a>
                        </td>
                        <td>
                            {{--                            không được xóa user đang đăng nhập --}}
                            @if(Auth::user()->id!==$item->id)
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này chứ?')"
                                   href="{{route('admin.users.delete', [$item->id])}} "
                                   class="btn btn-danger btn-sm @cannot('users.delete') disabled @endcannot">Xóa</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    @if($usersNotChange->count() > 0)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">STT</th>
                <th width="30%">Tên</th>
                <th width="35%">Email</th>
                <th width="20&">Nhóm</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
            </thead>
            <tbody>
                @foreach($usersNotChange as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->group->name}}</td>
                        <td>
                            <a href="{{route('admin.users.edit',[$item->id] )}}"
                               class="btn btn-warning btn-sm disabled"
                            >Sửa</a>
                        </td>
                        <td>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này chứ?')"
                                   href="{{route('admin.users.delete', [$item->id])}} "
                                   class="btn btn-danger btn-sm disabled">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
{{--    Làm sao để khi ấn xóa nó sẽ lấy được id thằng xóa và gửi vào hàm route--}}
    <!-- Delete Modal-->
{{--    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
{{--         aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Chắc Chắn Bạn Muốn Xóa Chứ?</h5>--}}
{{--                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">Làm sao để khi ấn xóa nó sẽ lấy được id thằng xóa và gửi vào hàm route</div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>--}}
{{--                    <a class="btn btn-primary" href="{{ route('admin.users.delete', [3]) }}">Xóa</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
