@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/shipping/shippingToBranch/index.js')}}"></script>
@endpush
@section('content')
    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Envíos</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Distribuidor</th>
                            <th>No. orden</th>
                            <th>Fecha compra</th>
                            <th>Status</th>
                            <th>Orden de compra</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_shippingToBranch_index_content')}}">
    <input type="hidden" value="{{route('admin_shippingToBranch_show',['orderId' => 'FAKE_ID'])}}" id="inp-url-show">
    <input type="hidden" value="{{route('admin_shippingToBranch_updateStatus',['orderId' => 'FAKE_ID'])}}" id="inp-url-status">


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
