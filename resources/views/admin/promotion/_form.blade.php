<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($promotion) ? $promotion->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="description" class="focused form-label">Descripción</label>
            <input type="text" class="form-control" autocomplete="off" id="description" name="description" value="{{ isset($promotion) ? $promotion->description : null}}">
            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="min_amount" class="focused form-label">Cantidad minima</label>
            <input type="number" class="form-control" autocomplete="off" id="min_amount" name="min_amount" value="{{ isset($prmotion) ? $promotion->min_amount : null}}">
            <span class="invalid-feedback">{{ $errors->first('min_amount') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="expiration_date" class="focused form-label">Fecha de expiración</label>
            <input type="date" class="form-control" autocomplete="off" id="expiration_date" name="expiration_date" value="{{ isset($promotion) ? $promotion->expiration_date : null}}">
            <span class="invalid-feedback">{{ $errors->first('expiration_date') }}</span>
        </div>
    </div>
</div>
