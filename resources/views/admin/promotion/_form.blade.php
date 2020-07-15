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
            <label for="begin_date" class="focused form-label">Fecha de inicio </label>
            <input type="date" class="form-control" autocomplete="off" id="begin_date" name="begin_date" value="{{ isset($promotion) ? $promotion->begin_date : null}}">
            <span class="invalid-feedback">{{ $errors->first('begin_date') }}</span>
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



<div class="row w-75">
    <div class="col-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="with_points" class="custom-control-input" id="with_points" value="1"  {{isset($promotion) ? ($promotion->with_points ? 'checked':'') : ''}} >
            <label class="custom-control-label" for="with_points">Promoción con puntos </label>
            <span class="invalid-feedback">{{ $errors->first('with_points') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="custom-control custom-checkbox">
            <input type="checkbox"  name="is_accumulative" class="custom-control-input" id="is_accumulative" value="1" {{isset($promotion) ? ($promotion->is_accumulative ? 'checked':'') : ''}} >
            <label class="custom-control-label" for="is_accumulative">Acumulado </label>
            <span class="invalid-feedback">{{ $errors->first('is_accumulative') }}</span>
        </div>
    </div>
</div>

<br/>





<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="country" class="focused form-label">Seleccionar País para promoción</label>
            <select class="form-control" id="fk_id_country" name="fk_id_country">
                @foreach(\App\Models\Country::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($branch) ? ($branch->address->fk_id_country == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
