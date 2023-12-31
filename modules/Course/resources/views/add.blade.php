@extends('layouts.backend')
@section('content')
    <form action="" method="post">
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tên</label>
                    <input type="text" name="name"
                           class="form-control title {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Tên..."
                           value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Slug</label>
                    <input type="text" name="slug"
                           class="form-control slug {{ $errors->has('slug') ? 'is-invalid' : '' }}" placeholder="Slug..."
                           value="{{ old('slug') }}">
                    @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id=""
                            class="form-control form-select {{ $errors->has('teacher_id') ? 'is-invalid' : '' }}">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Nguyễn Minh Hiếu</option>
                    </select>
                    @error('teacher_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Mã khóa học</label>
                    <input type="text" name="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                           placeholder="Mã khóa học..." id="">
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khóa học</label>
                    <input type="number" name="price"
                           class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Giá khóa học..."
                           id="">
                    @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number" name="sale_price"
                           class="form-control {{ $errors->has('sale_price') ? 'is-invalid' : '' }}"
                           placeholder="Giá khuyến mãi..." id="">
                    @error('sale_price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id=""
                            class="form-control form-select {{ $errors->has('is_document') ? 'is-invalid' : '' }}">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                    @error('is_document')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-6">
                <div class="mb-3">
                    <label for="">Trạng thái</label>
                    <select name="status" id=""
                            class="form-control form-select {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <option value="0">Chưa ra mắt</option>
                        <option value="1">Đã ra mắt</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="supports" class="form-control {{ $errors->has('supports') ? 'is-invalid' : '' }}"
                              placeholder="Hỗ trợ..."></textarea>
                    @error('supports')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="">Nội dung</label>
                    <textarea name="detail"
                              class="form-control editor {{ $errors->has('detail') ? 'is-invalid' : '' }}"
                              placeholder="Nội dung..."
                              rows="10" cols="80"
                    ></textarea>
                    @error('detail')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <div class="row align-items-end">
                        <div class="col-7">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" name="thumbnail"
                                   class="form-control {{ $errors->has('thumbnail') ? 'is-invalid' : '' }}"
                                   placeholder="Ảnh đại diện..." id="">
                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary">
                                Chọn ảnh
                            </button>
                        </div>
{{--                        https://mdbootstrap.com/docs/standard/extended/file-input-image/--}}
                        <div class="col-3">
                            <img src="https://fastly.picsum.photos/id/866/1000/600.jpg?hmac=An7fELfe7MSZ868dqoFWXa4ZpYsxHrR4pjHsyvDtLJI"
                                 alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
    </form>
@endsection

@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
