@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection


@section('content')
    <h1>Thêm Sản Phẩm</h1>
    <form action="" method="POST">
        <input type="text" name="username" id="">
        @csrf
        <button type="submit" >Submit</button>
    </form>
@endsection
@section('css')

@endsection
@section('js')

@endsection
