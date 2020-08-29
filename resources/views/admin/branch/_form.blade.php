<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($branch) ? $branch->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="street" class="focused form-label">Calle</label>
            <input type="text" class="form-control" autocomplete="off" id="street" name="street" value="{{ isset($branch) ? $branch->address->street : null}}">
            <span class="invalid-feedback">{{ $errors->first('street') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="zip_code" class="focused form-label">Código postal</label>
            <input type="text" class="form-control" autocomplete="off" id="zip_code" name="zip_code" value="{{ isset($branch) ? $branch->address->zip_code : null}}">
            <span class="invalid-feedback">{{ $errors->first('zip_code') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="ext_num" class="focused form-label">Número Exterior</label>
            <input type="text" class="form-control" autocomplete="off" id="ext_num" name="ext_num" value="{{ isset($branch) ? $branch->address->ext_num : null}}">
            <span class="invalid-feedback">{{ $errors->first('ext_num') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="int_num" class="focused form-label">Número Interior</label>
            <input type="text" class="form-control" autocomplete="off" id="int_num" name="int_num" value="{{ isset($branch) ? $branch->address->int_num : null}}">
            <span class="invalid-feedback">{{ $errors->first('int_num') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="colony" class="focused form-label">Colonia</label>
            <input type="text" class="form-control" autocomplete="off" id="colony" name="colony" value="{{ isset($branch) ? $branch->address->colony : null}}">
            <span class="invalid-feedback">{{ $errors->first('colony') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="city" class="focused form-label">Ciudad</label>
            <input type="text" class="form-control" autocomplete="off" id="city" name="city" value="{{ isset($branch) ? $branch->address->city : null}}">
            <span class="invalid-feedback">{{ $errors->first('city') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="state" class="focused form-label">Estado</label>
            <input type="text" class="form-control" autocomplete="off" id="state" name="state" value="{{ isset($branch) ? $branch->address->state : null}}">
            <span class="invalid-feedback">{{ $errors->first('state') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="country" class="focused form-label">País</label>
            <select class="form-control" id="fk_id_country" name="fk_id_country">
                @foreach(\App\Models\Country::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($branch) ? ($branch->address->fk_id_country == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
