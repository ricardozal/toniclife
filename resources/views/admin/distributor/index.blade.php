@extends('template.main')
@push('scripts')
    <script src="{{asset('commons/jquery.autocomplete.min.js')}}"></script>
    <script src="{{asset('js/admin/distributor/index.js?v=3')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Distribuidores</strong>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 justify-content-end d-flex align-items-center">
                    <a id="create-btn" class="btn btn-primary" href="{{route('admin_distributor_create')}}">
                        Agregar distribuidor
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>ID Tonic Life</th>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Distribuidor líder</th>
                            <th>Puntos acumulados periodo actual</th>
                            <th>País</th>
                            <th>Opciones</th>
                            <th>Activar/Desactivar</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_distributor_index_content')}}">
    <input id="inp-url-active" type="hidden"
           value="{{route('admin_distributor_active',['distributorId' => 'FAKE_ID'])}}">
    <input id="inp-url-update" type="hidden"
           value="{{route('admin_distributor_update',['distributorId' => 'FAKE_ID'])}}">
    <input id="inp-url-distributor-search" type="hidden"
           value="{{route('admin_distributor_search')}}">

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
