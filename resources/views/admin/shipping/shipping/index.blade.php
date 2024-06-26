@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/shipping/index.js?v=2')}}"></script>
@endpush
@section('content')
    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">{{trans('index.env')}}</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{trans('index.suc')}}</th>
                            <th>{{trans('index.org')}}</th>
                            <th>{{trans('index.des')}}</th>
                            <th>{{trans('index.fol')}}</th>
                            <th>{{trans('index.date')}}</th>
                            <th>{{trans('index.ng')}}</th>
                            <th>Status</th>
                            <th>{{trans('index.opc')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <input id="inp-url-index-content" type="hidden"
           value="{{Auth::user()->isBranch() ? route('branch_shipping_index_content') : route('admin_shipping_index_content')}}">
    <input type="hidden" value="{{Auth::user()->isBranch() ? route('branch_shipping_guide_number', ['orderId' => 'FAKE_ID']) : route('admin_shipping_guide_number', ['orderId' => 'FAKE_ID'])}}" id="inp-url-shipping">
    <input type="hidden" value="{{Auth::user()->isBranch() ? route('branch_order_show',['orderId' => 'FAKE_ID']) : route('admin_order_show',['orderId' => 'FAKE_ID'])}}" id="inp-url-show">

    <div id='modal-upsert' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-content"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
