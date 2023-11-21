@extends('layouts.admin')
@section('title', 'Danh Sách Người Dùng')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Người Dùng</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if($errors->any())
        <div class="alert-danger alert text-center">Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="{{route('admin.users.add')}}" method="post">
        <div class="mb-3">
            <label>Họ Và Tên</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus placeholder="Họ Và Tên...">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label>Địa chỉ Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus placeholder="Địa Chỉ Email...">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label>Mật Khẩu</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Mật Khẩu...">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label>Nhóm</label>
            <select name="group_id" class="form-control @error('group_id') is-invalid @enderror">
                <option value="0">Chọn Nhóm</option>
                @if($groups->count() > 0)
                    @foreach($groups as $group )
                        <option class="" value="{{$group->id}}" {{old('group_id') == $group->id ? 'selected' : false}} >{{$group->name}}</option>
                    @endforeach
                @endif
            </select>
            @error('group_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">Thêm mới</button>
        <a href="{{route('admin.users.index')}}" class="btn btn-success btn-sm">Quay Lại</a>
    </form>
@endsection