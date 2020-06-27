@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/inventory/menu.js')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Inventarios</strong>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div style="cursor: pointer" class="col-12 col-md-2 card card-option local-inventory">
                            <div class="card-body">
                                <i class="fas fa-building mb-3" style="font-size: 6rem"></i>
                                <label>Inventario Local</label>
                            </div>
                        </div>
                        <div style="cursor: pointer" onclick="location.href='{{route('admin_inventory_global_index')}}'" class="col-12 col-md-2 card card-option">
                            <div class="card-body">
                                <i class="fas fa-globe-americas mb-3" style="font-size: 6rem"></i>
                                <label>Inventario Global</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="{{route('admin_inventory_local_index',['branchId' => 'FAKE_ID'])}}" id="inp-url-inventory-local">

    <div id='modal-menu-inv' class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="body-content">
                        <div class="d-flex flex-column align-items-center mb-5">
                            <h4 class="text-header mt-2">Sucursales</h4>
                        </div>
                        <div class="row">
                            <div class="d-flex flex-column align-items-center w-100">
                                <div class="row w-75">
                                    <div class="col-12">
                                        <div class="form-group form-select focused">
                                            <label for="fk_id_branch" class="focused form-label">Por favor, elija una sucursal para ver su inventario</label>
                                            <select class="form-control " id="fk_id_branch">
                                                <option value="0">-- Elegir sucursal --</option>
                                                @foreach(\App\Models\Branch::asMap() as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center w-75">
                                    <button type="button" class="btn btn-primary select-branch">
                                        Ir a sucursal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
