<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Número de guía de envío</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{route('admin_shipping_guide_number_post',['orderId' => $order->id])}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf

        <div class="row w-75">
            <div class="col-12">
                <div class="form-group focused">
                    <label for="name"  class="focused form-label">Número de guía</label>
                    <input type="text" class="form-control" autocomplete="off" id="value" name="value" value="{{ isset($order->guideNumber) ? $order->guideNumber->value : null}}">
                    <span class="invalid-feedback">{{ $errors->first('value') }}</span>
                </div>
            </div>
        </div>

        <div class="row w-75">
            <div class="col-12">
                <div class="form-group form-select focused">
                    <label for="fk_id_role" class="focused form-label">Paquetería</label>
                    <select class="form-control" id="fk_id_office_parcel" name="fk_id_office_parcel">
                        @foreach(\App\Models\OfficeParcel::asMap() as $id => $name)
                            <option value="{{$id}}" {{isset($order->guideNumber) ? ($order->guideNumber->fk_id_office_parcel == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </div>
    </form>
</div>
