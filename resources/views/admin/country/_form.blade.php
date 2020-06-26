<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($country) ? $country->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="tax_percentage">IVA</label>
            <input type="number" step="0.01" min="0" class="form-control" id="tax_percentage" name="tax_percentage" value="{{ isset($country) ? $country->tax_percentage : null}}">
            <span class="invalid-feedback">{{ $errors->first('tax_percentage') }}</span>
        </div>
    </div>
</div>
