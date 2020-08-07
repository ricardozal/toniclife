@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/shipping/index.js')}}"></script>
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
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>Folio orden de compra</th>
                            <th>Fecha compra</th>
                            <th>Número de guía</th>
                            <th>Status</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_shipping_index_content')}}">
    <input type="hidden" value="" id="inp-url-shipping">
@endsection
