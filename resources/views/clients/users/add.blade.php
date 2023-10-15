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
    @if($errors->any())
        <div class="alert alert-danger">Dữ Liệu Nhập Vào Không Hợp Lệ</div>
    @endif
    <h1>{{ $title }}</h1>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Họ Và Tên</label>
            <input type="text" class="form-control" name="name"
                   placeholder="Họ Và Tên..." value="{{old('name')}}">
            @error('name')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email"
                   placeholder="Email..." value="{{old('email')}}">
            @error('email')
            <span style="color: red">{{$message}}</span>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Thêm Mới</button>
        <a href="{{route('users.index')}}" class="btn btn-warning">Quay Lại</a>
    </form>
@endsection
