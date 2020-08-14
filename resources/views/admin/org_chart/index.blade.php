@extends('template.main')
@push('scripts')
    <script src="{{asset('commons/jquery-ui-1.10.4.custom.min.js')}}"></script>
    <script src="{{asset('js/admin/org_chart/jQuery.jHTree.js')}}"></script>
    <script src="{{asset('js/admin/org_chart/index.js')}}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{asset('commons/tree_maker/jquery-ui.min.css')}}">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('commons/tree_maker/jHTree.css')}}">
@endpush

@section('content')

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
                    <div id="tree">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_org_chart_index_content')}}">

    <div id='modal-show' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-content"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
