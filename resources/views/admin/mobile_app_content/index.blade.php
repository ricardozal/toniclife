@extends('template.main')
@push('scripts')

    <script src="{{asset('js/admin/app_mobile_content/index.js?v=1')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">

            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Enlaces de app móvil</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo de enlace</th>
                            <th>Enlace</th>
                            <th>Modificar</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>


    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_app_mobile_content_index_content')}}">
    <input id="inp-url-update" type="hidden"
           value="{{route('admin_app_mobile_content_update',['contentId' => 'FAKE_ID'])}}">


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
