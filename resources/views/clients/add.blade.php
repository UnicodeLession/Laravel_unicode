@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection


@section('content')
    <h1>Thêm Sản Phẩm</h1>

    <form action="" method="POST">
        @if ($errors->any())
{{--            @dd($errors->any())--}}
            <div class="alert alert-danger text-center">
                Vui lòng kiểm tra lại dữ liệu
            </div>
        @endif
        <div class="mb-3">
            <label>Tên Sản Phẩm</label>
            <input type="text" class="form-control" name="product_name" placeholder="Tên Sản Phẩm">
            @error('product_name')
                <span style="color:red;"> {{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label>Giá Sản Phẩm</label>
            <input type="text" class="form-control" name="product_price" placeholder="Giá Sản Phẩm">
            @error('product_price')
            <span style="color:red;"> {{ $message }}</span>
            @enderror
        </div>
        @csrf
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
@section('css')

@endsection
@section('js')

@endsection
