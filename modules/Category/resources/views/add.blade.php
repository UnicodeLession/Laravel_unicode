@extends('layouts.backend')
@section('content')
    @if($errors->any())
        <div class="alert-danger alert text-center">Vui Lòng Kiểm Tra Lại Dữ Liệu Đã Nhập</div>
    @endif
    <form action="" method="post">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input id="title" name="name" type="text" class="form-control
                    @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" autofocus placeholder="Tiêu Đề...">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <label for="">Đường Dẫn Tĩnh</label>
                <div class="mb-3 input-group">
                    <input id="slug" name="slug" type="text"
                           class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}"
                           autofocus placeholder="Đường dẫn tĩnh..."
                    >
                    <button style="border-left: 0; border-radius: 0 10px 10px 0; border-color: #BAC8F3;"
                            id="btn-slug" class="btn btn-outline-secondary" type="button">Title</button>
                    @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Category Cha</label>
                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                        <option value="0">Không</option>
                        {{old('parent_id')}}
                        {{getCategories($categories, old('parent_id'))}}
                    </select>
                    @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{route('admin.categories.index')}}" class="btn btn-danger">Hủy</a>
            </div>
        </div>

    </form>
@endsection
