<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="{{ asset('assets/clients/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/clients/css/style.css') }}">
    @yield('css')
</head>
<body>
@include('clients.blocks.header')
<main class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <aside>
                    @section('sidebar')
                        @include('clients.blocks.sidebar')
                    @show
                </aside>
            </div>
            <div class="col-8">
                <div class="content">
                    @yield('content')
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
