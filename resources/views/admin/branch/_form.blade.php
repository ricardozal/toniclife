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
            <label for="street">Calle</label>
            <input type="text" class="form-control" id="street" name="street" value="{{ isset($branch) ? $branch->address->street : null}}">
            <span class="invalid-feedback">{{ $errors->first('street') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="zip_code">Código postal</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ isset($branch) ? $branch->address->zip_code : null}}">
            <span class="invalid-feedback">{{ $errors->first('zip_code') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="ext_num">Número Exterior</label>
            <input type="text" class="form-control" id="ext_num" name="ext_num" value="{{ isset($branch) ? $branch->address->ext_num : null}}">
            <span class="invalid-feedback">{{ $errors->first('ext_num') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="colony">Colonia</label>
            <input type="text" class="form-control" id="colony" name="colony" value="{{ isset($branch) ? $branch->address->colony : null}}">
            <span class="invalid-feedback">{{ $errors->first('colony') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="city">Ciudad</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ isset($branch) ? $branch->address->city : null}}">
            <span class="invalid-feedback">{{ $errors->first('city') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="state">Estado</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ isset($branch) ? $branch->address->state : null}}">
            <span class="invalid-feedback">{{ $errors->first('state') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="country">País</label>
            <select class="form-control" id="fk_id_country" name="fk_id_country">
                @foreach(\App\Models\Country::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($branch) ? ($branch->address->fk_id_country == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
