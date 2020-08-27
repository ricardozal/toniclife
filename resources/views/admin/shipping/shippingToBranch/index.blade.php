@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/shipping/shippingToBranch/index.js')}}"></script>
@endpush
@section('content')
    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">{{trans('index.rs')}}</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{trans('index.suc')}}</th>
                            <th>{{trans('index.dis')}}</th>
                            <th>{{trans('index.no')}}</th>
                            <th>{{trans('index.date')}}</th>
                            <th>Status</th>
                            <th>Ticket</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{Auth::user()->isBranch() ? route('branch_pickup_index_content') : route('admin_shippingToBranch_index_content')}}">
    <input type="hidden" value="{{Auth::user()->isBranch() ? route('branch_order_show', ['orderId' => 'FAKE_ID']) : route('admin_order_show',['orderId' => 'FAKE_ID'])}}" id="inp-url-show">
    <input type="hidden" value="{{Auth::user()->isBranch() ? route('branch_pickup_deliver',['orderId' => 'FAKE_ID']) : route('admin_pickup_at_branch_deliver',['orderId' => 'FAKE_ID'])}}" id="inp-url-deliver">


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
