<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="code" class="focused form-label">Código</label>
            <input type="text" class="form-control" autocomplete="off" id="code" name="code" value="{{ isset($product) ? $product->code : null}}">
            <span class="invalid-feedback">{{ $errors->first('code') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($product) ? $product->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

@isset($product)
    <div class="w-75 text-center">
        <span>Elige una imagen si deseas cambiarla</span>
    </div>
@endif
<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <input id="inp-image" name="file" type="file" class="custom-file-input">
            <label class="inp-file-msg">Imagen</label>
            <label id="lbl-image" class="custom-file-label focused  {{ $errors->has('file') ? ' is-invalid' : '' }}"
                   for="inp-image">
            </label>
            <span class="invalid-feedback">{{ $errors->first('file') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="distributor_price" class="focused form-label">Precio distribuidor</label>
            <input type="number" step="0.01" min="0" autocomplete="off" class="form-control" id="distributor_price" name="distributor_price" value="{{ isset($product) ? $product->distributor_price : null}}">
            <span class="invalid-feedback">{{ $errors->first('distributor_price') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="points" class="focused form-label">Puntos</label>
            <input type="number" min="0" autocomplete="off" class="form-control" id="points" name="points" value="{{ isset($product) ? $product->points : null}}">
            <span class="invalid-feedback">{{ $errors->first('points') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="country" class="focused form-label">Catálogo</label>
            <select class="form-control" id="fk_id_country" name="fk_id_country">
                @foreach(\App\Models\Country::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($product) ? ($product->fk_id_country == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>

