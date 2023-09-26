@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('sidebar')
    @parent
    {{--
    nếu không có @parent thì bên client.blade cũng có section('sidebar') và nó sẽ thay thế luôn bên kia
    --}}
    <h3>Home Sidebar</h3>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-{{session('type')}} text-center">
            {{ session('msg') }}
        </div>
    @endif

    <h1>Trang Chủ</h1>

@endsection
@section('css')

@endsection
@section('js')

@endsection