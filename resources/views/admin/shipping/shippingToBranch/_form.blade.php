<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="country" class="focused form-label">Estatus</label>
            <select class="form-control" id="fk_id_order_status" name="fk_id_order_status">
                @foreach(\App\Models\OrderStatus::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($order) ? ($order->status->fk_id_order_status == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
