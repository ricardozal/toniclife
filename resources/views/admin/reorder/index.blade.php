@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/reorder/index.js')}}"></script>
@endpush
@section('content')
    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Reorden de compra</strong>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive nowrap text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>Nombre  </th>
                            <th>ID Tonic</th>
                            <th>Fecha</th>



                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_reorder_index_content')}}">


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
