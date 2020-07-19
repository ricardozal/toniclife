@extends('template.main')
@push('scripts')
    <script src="{{asset('js/admin/shipping/menu.js')}}"></script>
@endpush
@section('content')

    <div class="row mt-5 mx-0">
        <div class="col-12">
            <div class="row">
                <div class="col-12 justify-content-center d-flex align-items-center">
                    <strong class="text-color-primary" style="font-size: 150%">Entregas</strong>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div style="cursor: pointer" onclick="location.href='{{route('admin_shipping_index')}}'" class="col-12 col-md-2 card card-option local-inventory">
                            <div class="card-body">
                                <i class="fas fa-paper-plane mb-3" style="font-size: 6rem"></i><br>
                                <label>Envíos</label>
                            </div>
                        </div>
                        <div style="cursor: pointer" onclick="location.href='{{route('admin_shipping_branch_index')}}'" class="col-12 col-md-2 card card-option">
                            <div class="card-body">
                                <i class="fas fa-store mb-3" style="font-size: 6rem"></i>
                                <label>Recoger en sucursal</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
