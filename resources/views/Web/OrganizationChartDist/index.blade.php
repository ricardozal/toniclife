<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--    <link rel="shortcut icon" type="image/png" href="">--}}
    <title>Red de distribuidores</title>

    @push('scripts')
        <script src="{{asset('commons/jquery-ui-1.10.4.custom.min.js')}}"></script>
        <script src="{{asset('js/Web/org_chart/jQuery.jHTree.js')}}"></script>
        <script src="{{asset('js/Web/org_chart/index.js')}}"></script>
    @endpush

    @push('css')
        <link rel="stylesheet" href="{{asset('commons/tree_maker/jquery-ui.min.css')}}">
        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('commons/tree_maker/jHTree.css')}}">
    @endpush

<!-- Style sheets -->
    @include('template.global_css')
    @stack('css')
</head>

<body>
<div class="row mt-5 mx-0">
    <div class="col-12">
        <div class="row">
            <div class="col-12 justify-content-center d-flex align-items-center">
                <strong class="text-color-primary" style="font-size: 150%">Red de distribuidores</strong>
            </div>
            <div class="col-12 justify-content-center d-flex align-items-center">
                <strong class="text-color-primary" style="font-size: 110%">Periodo actual: {{\App\Services\DateFormatterService::fullDatetime($begin_period).' al '.\App\Services\DateFormatterService::fullDatetime($end_period)}}</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="fa-3x text-center">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
                <div id="tree" class="d-none">
                </div>
            </div>
        </div>
    </div>
</div>


<input id="inp-url-index-content" type="hidden"
       value="{{route('web_org_chart_index_content', ['tonic_life_id' => $tonic_life_id])}}">


<!-- Javascript -->
@include('template.global_js')
@stack('scripts')
</body>
</html>
