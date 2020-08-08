<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($officeParcel) ? $officeParcel->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>
