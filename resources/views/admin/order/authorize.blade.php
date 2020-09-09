<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Orden {{$orderId}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{route('admin_order_authorize_post',['orderId' => $orderId])}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        <div class="row w-75 mb-5">
            <div class="col-12">
                <h3>Seleccione si desea cancelar o autorizar compra</h3>
            </div>
        </div>
        <div class="row w-75">
            <div class="col-12">
                <div class="form-group form-select focused">
                    <label for="fk_id_order_status" class="focused form-label">Seleccione una opción</label>
                    <select class="form-control" id="fk_id_order_status" name="fk_id_order_status">
                        @foreach(\App\Models\OrderStatus::asMapAuthorize() as $id => $name)
                            <option value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Aceptar
            </button>
        </div>
    </form>
</div>
