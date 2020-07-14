@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/inventory/Global/movements.js')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Historial de movimientos de {{$product->name}}</strong>
                </div>
            </div>
            <div class="row">
                <br>
                <br>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>Movimiento</th>
                            <th>Comentario</th>
                            <th>Cantidad</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-contentTableMovements" type="hidden"
           value="{{route('admin_inventory_global_showTableMovements', ['fk_id_product' => $product->id])}}">

@endsection
