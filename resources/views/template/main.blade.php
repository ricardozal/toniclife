<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <link rel="shortcut icon" type="image/png" href="">--}}
    <title>@yield('title', 'Tonic Life Fénix') </title>
    <!-- Style sheets -->
    @include('template.global_css')
    @stack('css')
</head>
<body>

    <div class="container-fluid">

        <div class="row main-card m-3">
            <div class="col-12">
                <div class="row d-block d-md-none">
                    <div class="col-12 p-0">
                        @include('components.navbar')
                    </div>
                </div>
                <div class="row {{Auth::user()->isBranch() ? 'h-100' : ''}}">
                    <div class="col-md-2 p-0 d-none d-md-block">
                        @include('components.sidebar')
                    </div>
                    <div class="col-12 col-md-10 px-0 pb-5">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>

        @include('components.footer')
    </div>

<!-- Javascript -->
@include('template.global_js')
@stack('scripts')
</body>
</html>
