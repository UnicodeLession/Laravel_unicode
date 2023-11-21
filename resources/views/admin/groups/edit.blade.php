@extends('layouts.admin')
@section('title', 'Cập Nhật Người Dùng')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập Nhật Nhóm</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if(session('msg'))
        <div class="alert alert-{{session('type')}} text-center">
            {{session('msg')}}
        </div>
    @endif
    @if($errors->any())
        <div class="alert-danger alert text-center">Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="" method="post">
        <div class="mb-3">
            <label>Tên</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                   value="{{old('name') ?? $group->name }}"
                   {{--ưu tiên old nếu tồn tại old còn k thì dùng user->name--}}
                   autofocus placeholder="Họ Và Tên...">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">Cập Nhật</button>
        <a href="{{route('admin.users.index')}}" class="btn btn-success btn-sm">Quay Lại</a>
    </form>
@endsection
