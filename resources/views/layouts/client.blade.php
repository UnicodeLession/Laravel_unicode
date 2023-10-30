<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    @yield('css')
</head>
<body>
@include('clients.blocks.header')
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <aside>
                    @section('sidebar')
                        @include('clients.blocks.sidebar')
                    @show
                </aside>
            </div>
            <div class="col-9">
                <div class="content">
                    @yield('content')
{{--                    <x-package-alert type="danger" : message="Đặt hàng không thành công" : data-icon="xmark"/>--}}
                </div>
            </div>
        </div>
    </div>
</main>
@include('clients.blocks.footer')
<script src="{{ asset('assets/clients/js/custom.css') }}"></script>
<script src="{{ asset('assets/clients/js/bootstrap.min.css') }}"></script>
@yield('js')
</body>
</html>
