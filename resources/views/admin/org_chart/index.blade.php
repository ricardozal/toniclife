@extends('template.main')
@push('scripts')
    <link rel="stylesheet" href="{{asset('commons/tree_maker/jquery-ui.min.css')}}">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
            crossorigin="anonymous">
    </script>
    <script src="{{asset('js/admin/org_chart/jquery-ui-1.10.4.custom.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('commons/tree_maker/jHTree.css')}}">
    <script src="{{asset('js/admin/org_chart/jQuery.jHTree.js')}}"></script>
    <script src="{{asset('js/admin/org_chart/jquery-1.10.2.js')}}"></script>

@endpush

@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Red de distribuidores</strong>
                </div>
                <div class="container">
                    <br />
                    <div id="tree">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_org_chart_index_content')}}">

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
@endsection
