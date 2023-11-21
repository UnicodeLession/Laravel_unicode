@extends('layouts.admin')
@section('title', 'Cập Nhật Bài Viết')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cập Nhật Bài Viết</h1>
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
            <label>Tiêu Đề</label>
            <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') ?? $post->title }}" autofocus placeholder="Tiêu Đề Bài Viết...">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="mb-3">
            <label>Nội Dung</label>
            <textarea name="content_post" class="form-control @error('content_post') is-invalid @enderror" rows="10" placeholder="Nội Dung Bài Viết...">{{ old('content_post') ?? $post->content }}</textarea>
            @error('content_post')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">Cập Nhật</button>
        <a href="{{route('admin.posts.index')}}" class="btn btn-success btn-sm">Quay Lại</a>
    </form>
@endsection
