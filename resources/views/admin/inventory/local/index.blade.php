@extends('template.main')
@push('scripts')

@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Inventario de {{$branch->name}}</strong>
                </div>
            </div>
        </div>
    </div>

    <input id="inp-url-index-content" type="hidden"
           value="{{route('admin_inventory_local_index_content',['branchId' => $branch->id])}}">

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