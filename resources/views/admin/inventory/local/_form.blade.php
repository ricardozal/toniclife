<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="stock" class="focused form-label">Stock</label>
            <input type="number" min="0" autocomplete="off" class="form-control" id="stock" name="stock" value="{{ isset($inventoryL) ? $inventoryL->stock : null}}">
            <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
        </div>
    </div>
</div>
<input type="hidden" name="branchId" value="{{$branchId}}">
