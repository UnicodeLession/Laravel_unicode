@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    @parent
    {{--
    nếu không có @parent thì bên client.blade cũng có section('sidebar') và nó sẽ thay thế luôn bên kia
    --}}
    <h3>Products Sidebar</h3>
@endsection

@section('content')
    <h1>Sản Phẩm</h1>
@endsection
@section('css')

@endsection
@section('js')

@endsection
