<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($promotion) ? $promotion->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ isset($promotion) ? $promotion->description : null}}">
            <span class="invalid-feedback">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="min_amount">Cantidad minima</label>
            <input type="number" class="form-control" id="min_amount" name="min_amount" value="{{ isset($prmotion) ? $promotion->min_amount : null}}">
            <span class="invalid-feedback">{{ $errors->first('min_amount') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="expiration_date">Fecha de expiración</label>
            <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ isset($promotion) ? $promotion->expiration_date : null}}">
            <span class="invalid-feedback">{{ $errors->first('expiration_date') }}</span>
        </div>
    </div>
</div>
