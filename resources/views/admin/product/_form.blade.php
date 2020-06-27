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

