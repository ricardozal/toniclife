@extends('template.main')
@push('scripts')
    <script src="{{asset('commons/jquery.autocomplete.min.js')}}"></script>
    <script src="{{asset('js/admin/inventory/Local/index.js')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">{{trans('index.invmetepec')}} {{$branch->name}}</strong>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-12 justify-content-end d-flex align-items-center">
                    <a id="create-btn" class="btn btn-primary" href="{{route('branch_inventory_create')}}">
                        {{trans('index.agregar')}}
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="table-data" class="table table-striped table-bordered dt-responsive text-center" style="width:100%">
                        <thead>
                        <tr>
                            <th>{{trans('index.cod')}}</th>
                            <th>{{trans('index.prod')}}</th>
                            <th>{{trans('index.st')}}</th>
                            <th>{{trans('index.opc')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('branch_inventory_index_content')}}">
    <input id="inp-url-update" type="hidden"
           value="{{route('branch_inventory_update',['productId'=> 'FAKE_ID'])}}">
    <input id="inp-url-product-search" type="hidden"
           value="{{route('branch_product_search', ['countryId' => $branch->is_matrix ? '0' : $branch->address->country->id])}}">

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
