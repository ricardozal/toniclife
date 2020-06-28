@extends('template.main')
@push('scripts')
    <script src="{{asset('commons/tree_maker/tree_maker-min.js')}}"></script>
    <script src="{{asset('js/admin/org_chart/index.js')}}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{asset('commons/tree_maker/tree_maker-min.css')}}">
{{--<style>--}}
{{--    /*Now the CSS*/--}}
{{--    * {margin: 0; padding: 0;}--}}

{{--    .tree ul {--}}
{{--        padding-top: 20px; position: relative;--}}

{{--        transition: all 0.5s;--}}
{{--        -webkit-transition: all 0.5s;--}}
{{--        -moz-transition: all 0.5s;--}}
{{--    }--}}

{{--    .tree li {--}}
{{--        float: left; text-align: center;--}}
{{--        list-style-type: none;--}}
{{--        position: relative;--}}
{{--        padding: 20px 5px 0 5px;--}}

{{--        transition: all 0.5s;--}}
{{--        -webkit-transition: all 0.5s;--}}
{{--        -moz-transition: all 0.5s;--}}
{{--    }--}}

{{--    /*We will use ::before and ::after to draw the connectors*/--}}

{{--    .tree li::before, .tree li::after{--}}
{{--        content: '';--}}
{{--        position: absolute; top: 0; right: 50%;--}}
{{--        border-top: 1px solid #ccc;--}}
{{--        width: 50%; height: 20px;--}}
{{--    }--}}
{{--    .tree li::after{--}}
{{--        right: auto; left: 50%;--}}
{{--        border-left: 1px solid #ccc;--}}
{{--    }--}}

{{--    /*We need to remove left-right connectors from elements without--}}
{{--    any siblings*/--}}
{{--    .tree li:only-child::after, .tree li:only-child::before {--}}
{{--        display: none;--}}
{{--    }--}}

{{--    /*Remove space from the top of single children*/--}}
{{--    .tree li:only-child{ padding-top: 0;}--}}

{{--    /*Remove left connector from first child and--}}
{{--    right connector from last child*/--}}
{{--    .tree li:first-child::before, .tree li:last-child::after{--}}
{{--        border: 0 none;--}}
{{--    }--}}
{{--    /*Adding back the vertical connector to the last nodes*/--}}
{{--    .tree li:last-child::before{--}}
{{--        border-right: 1px solid #ccc;--}}
{{--        border-radius: 0 5px 0 0;--}}
{{--        -webkit-border-radius: 0 5px 0 0;--}}
{{--        -moz-border-radius: 0 5px 0 0;--}}
{{--    }--}}
{{--    .tree li:first-child::after{--}}
{{--        border-radius: 5px 0 0 0;--}}
{{--        -webkit-border-radius: 5px 0 0 0;--}}
{{--        -moz-border-radius: 5px 0 0 0;--}}
{{--    }--}}

{{--    /*Time to add downward connectors from parents*/--}}
{{--    .tree ul ul::before{--}}
{{--        content: '';--}}
{{--        position: absolute; top: 0; left: 50%;--}}
{{--        border-left: 1px solid #ccc;--}}
{{--        width: 0; height: 20px;--}}
{{--    }--}}

{{--    .tree li a{--}}
{{--        border: 1px solid #ccc;--}}
{{--        padding: 5px 10px;--}}
{{--        text-decoration: none;--}}
{{--        color: #666;--}}
{{--        font-family: arial, verdana, tahoma;--}}
{{--        font-size: 11px;--}}
{{--        display: inline-block;--}}

{{--        border-radius: 5px;--}}
{{--        -webkit-border-radius: 5px;--}}
{{--        -moz-border-radius: 5px;--}}

{{--        transition: all 0.5s;--}}
{{--        -webkit-transition: all 0.5s;--}}
{{--        -moz-transition: all 0.5s;--}}
{{--    }--}}

{{--    /*Time for some hover effects*/--}}
{{--    /*We will apply the hover effect the the lineage of the element also*/--}}
{{--    .tree li a:hover, .tree li a:hover+ul li a {--}}
{{--        background: #c8e4f8; color: #000; border: 1px solid #94a0b4;--}}
{{--    }--}}
{{--    /*Connector styles on hover*/--}}
{{--    .tree li a:hover+ul li::after,--}}
{{--    .tree li a:hover+ul li::before,--}}
{{--    .tree li a:hover+ul::before,--}}
{{--    .tree li a:hover+ul ul::before{--}}
{{--        border-color:  #94a0b4;--}}
{{--    }--}}

{{--    /*Thats all. I hope you enjoyed it.--}}
{{--    Thanks :)*/--}}
{{--</style>--}}
@endpush
@section('content')


    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Red de distribuidores</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center align-items-center h-100">
                    <div id="my_tree"></div>
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <a href="#">Ajelandra</a>--}}
{{--                                <ul>--}}
{{--                                    @foreach($distributors->where('fk_id_distributor',null)->get() as $distributor)--}}
{{--                                        <li>--}}
{{--                                            <a href="#">{{$distributor->name}}</a>--}}
{{--                                            @if($distributor->distributors != null)--}}
{{--                                                <ul>--}}
{{--                                                    @foreach($distributor->distributors as $distributor)--}}
{{--                                                        <li>--}}
{{--                                                            <a href="#">{{$distributor->name}}</a>--}}
{{--                                                            @if($distributor->distributors != null)--}}
{{--                                                                <ul>--}}
{{--                                                                    @foreach($distributor->distributors as $distributor)--}}
{{--                                                                        <li>--}}
{{--                                                                            <a href="#">{{$distributor->name}}</a>--}}
{{--                                                                        </li>--}}
{{--                                                                    @endforeach--}}
{{--                                                                </ul>--}}
{{--                                                            @endif--}}
{{--                                                        </li>--}}
{{--                                                    @endforeach--}}
{{--                                                </ul>--}}
{{--                                            @endif--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-csrf"
           value="{{csrf_token()}}"
           type="hidden">
    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_org_chart_index_content')}}">
@endsection
