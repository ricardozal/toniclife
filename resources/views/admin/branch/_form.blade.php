<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($branch) ? $branch->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Calle</label>
            <input type="text" class="form-control" id="street" name="street">
            <span class="invalid-feedback">{{ $errors->first('street') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Código postal</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code">
            <span class="invalid-feedback">{{ $errors->first('zip_code') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Número Exterior</label>
            <input type="text" class="form-control" id="ext_num" name="ext_num">
            <span class="invalid-feedback">{{ $errors->first('ext_num') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Colonia</label>
            <input type="text" class="form-control" id="colony" name="colony">
            <span class="invalid-feedback">{{ $errors->first('colony') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city">
            <span class="invalid-feedback">{{ $errors->first('city') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Estado</label>
            <input type="text" class="form-control" id="state" name="state">
            <span class="invalid-feedback">{{ $errors->first('state') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">País</label>
            <select class="form-control" id="country" name="country">
            <option>México</option>
            <option>EEUU</option>
            <span class="invalid-feedback">{{ $errors->first('country') }}</span>
            </select>
        </div>

    </div>
</div>
