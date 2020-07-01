<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="type" class="focused form-label">Movimiento</label>
            <select class="form-control" id="type" name="type">
                <option value="1"> Positivo </option>
                <option value="0"> Negativo </option>
            </select>
        </div>

    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="stock" class="focused form-label">Cantidad de ajuste</label>
            <input type="number" min="1" class="form-control" id="stock" name="stock" value="" autocomplete="off">
            <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="comment" class="focused form-label">Comentario</label>
            <input type="text" class="form-control" autocomplete="off" id="comment" name="comment" value="">
            <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
        </div>
    </div>
</div>

<input type="hidden" name="branchId" value="{{$branch->id}}">
<input type="hidden" name="productId" value="{{$product->id}}">
