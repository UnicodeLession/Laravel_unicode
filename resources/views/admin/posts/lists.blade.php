@extends('layouts.admin')
@section('title', 'Danh Sách Bài Viết')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh Sách Bài Viết</h1>
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
    @can('create', App\Models\Post::class)
        <p><a href="{{route('admin.posts.add')}}" class="btn btn-primary btn-sm">Thêm mới</a></p>
    @endcan
    @if(!empty($postsByMe))
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tiêu Đề</th>
                <th width="25%">Người Đăng</th>
                <th width="5%">Xem</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @if ($postsByMe->count() > 0)
                @foreach($postsByMe as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{getLimitText($item->title)}}</td>
                        <td>{{$item->postBy->name}}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Xem</a>
                        </td>
                        <td>
                            <a href="{{route('admin.posts.edit',[$item->id] )}}"
                               class="btn btn-warning btn-sm @cannot('posts.edit')  disabled @endcannot">Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này chứ?')"
                               href="{{route('admin.posts.delete', [$item->id])}} "
                               class="btn btn-danger btn-sm @cannot('posts.delete') disabled @endcannot">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-danger text-center">Bạn Chưa Đăng Bài Viết Nào!</div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    @endif
    @if(!empty($postsByOther))
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Tiêu Đề</th>
                <th width="25%">Người Đăng</th>
                <th width="5%">Xem</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
            </tr>
            </thead>
            <tbody>
            @if ($postsByOther->count() > 0)
                @foreach($postsByOther as $key=>$item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{getLimitText($item->title)}}</td>
                        <td>{{$item->postBy->name}}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Xem</a>
                        </td>
                        <td>
                            <a href="{{route('admin.posts.edit',[$item->id] )}}" class="btn btn-warning btn-sm disabled">Sửa</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này chứ?')" href="{{route('admin.posts.delete', [$item->id])}} " class="btn btn-danger btn-sm disabled">Xóa</a>
                        </td>
                    </tr>
                @endforeach
            @endif
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
{{--                    <a class="btn btn-primary" href="{{ route('admin.posts.delete', [3]) }}">Xóa</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
