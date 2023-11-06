@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-{{session('type')}} text-center">
            {{ session('msg') }}
        </div>
    @endif
    <h1>{{ $title }}</h1>
    <a href="{{route('users.add')}}" class="btn btn-primary">Thêm Người dùng</a>
    <hr>
    <form action="" method="get" class="mb-3">
        <div class="row">
            <div class="col-3">
                <select class="form-control" name="group_id">
                    <option value="0">Tất Cả Nhóm</option>
                    @if(!empty(getAllGroups()))
                        @foreach(getAllGroups() as $item)
                            <option value="{{$item->id}}" {{request()->group_id==$item->id?'selected':false}}>{{$item->name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-3">
                <select class="form-control" name="status">
                    <option value="0">Tất Cả Trạng Thái</option>
                    <option value="active" {{request()->status=='active'?'selected':false}} >Kích Hoạt</option>
                    <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Chưa Kích Hoạt</option>
                </select>
            </div>
            <div class="col-4">
                <input type="search" name="keywords" value="{{request()->keywords}}" class="form-control" placeholder="Từ khóa tìm kiếm...">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary btn-block">Tìm Kiếm</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>
                    <a href="?sort-by=name&sort-type={{$sortType}}" >
                        Name
                        @if(!empty(request()->input('sort-by')) && request()->input('sort-by') == 'name')
                            @if(request()->input('sort-by'))
                                @el
                            @endif
                        @endif
                    </a>
                </th>
                <th >
                    <a href="?sort-by=email&sort-type={{$sortType}}" >
                        Email
{{--                        <i class="fa-solid fa-caret-down {{($sortType == 'desc' )?'d-none':false}}">--}}{{--Sắp xếp từ A-Z --}}{{--</i>--}}
{{--                        <i class="fa-solid fa-caret-up {{($sortType == 'asc' )?'d-none':false}}">--}}{{--Sắp xếp từ Z-A --}}{{--</i>--}}
                        {{--                        class d-none giúp ẩn icon đi theo kiểu sort--}}
                    </a>
                </th>
                <th>
                    Nhóm
                </th>
                <th>
                        Trạng Thái
                </th>
                <th width="15%">
{{--                    Mặc định là sắp xếp theo create_at nên lúc truy cập vào users thì phải có icon carot-down để thể hiện sự sắp xếp--}}
                    <a href="?sort-by=create_at&sort-type={{$sortType}}">Thời Gian</a>
                </th>
                <th WIDTH="10%">Sửa</th>
                <th WIDTH="10%">Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($usersList))
                @foreach($usersList as $key=>$user)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(($user->group_id)==1)
                            <span style="color: red">Không Nhóm</span>
                        @else
                            <span>{{$user->group_name}}</span>
                        @endif
                    </td>
                    <td>
                        @if(empty($user->status))
                            <button class="btn btn-danger btn-sm">Chưa Kích Hoạt</button>
                        @else
                            <button class="btn-sm btn btn-success">Kích Hoạt</button>
                        @endif
                    </td>
                    <td>{{ $user->create_at }}</td>
                    <td>
                        <a href="{{route('users.edit', ['id'=> $user->id])}}" class="btn btn-warning btn-sm">Sửa</a>
                    </td>
                    <td>
                        <a onclick="return confirm('Bạn Có Chắc Chắn Muốn Xóa Không?') " href="{{route('users.delete', ['id'=> $user->id])}}" class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">Không có người dùng</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
@section('js')
    <script>

    </script>
@endsection
