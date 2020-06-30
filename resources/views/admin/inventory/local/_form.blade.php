<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="code" class="focused form-label">Código de producto</label>
            <input type="text" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" id="code" name="code" value="" autocomplete="off">
            <span class="invalid-feedback">{{ $errors->first('code') }}</span>
        </div>
        <input type="hidden" value="" id="fk_id_product" name="fk_id_product">
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="stock" class="focused form-label">Stock</label>
            <input type="number" min="0" autocomplete="off" class="form-control" id="stock" name="stock" value="" autocomplete="off">
            <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
        </div>
    </div>
</div>
<input type="hidden" name="branchId" value="{{$branchId}}">
