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
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th>Name</th>
                <th>Email</th>
                <th width="15%">Time</th>
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
