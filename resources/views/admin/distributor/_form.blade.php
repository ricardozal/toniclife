<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">ID Tonic Life</label>
            <input type="text" class="form-control" autocomplete="off" id="tonic_life_id" name="tonic_life_id" value="{{ isset($distributor) ? $distributor->tonic_life_id : null}}">
            <span class="invalid-feedback">{{ $errors->first('tonic_life_id') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name" class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($distributor) ? $distributor->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="email" class="focused form-label">Correo electrónico</label>
            <input type="email" class="form-control" autocomplete="off" id="email" name="email" value="{{ isset($distributor) ? $distributor->email : null}}">
            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="password" class="focused form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value="">
            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="password" class="focused form-label">Confirmar contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
            <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="distributor_leader_name" class="focused form-label">Distribuidor líder</label>
            <input type="text" class="form-control {{ $errors->has('distributor_leader_name') ? ' is-invalid' : '' }}" id="distributor_leader_name" name="distributor_leader_name" value="{{ isset($distributor) ? ($distributor->distributor != null ? $distributor->distributor->name : null ) : null }}">
            <span class="invalid-feedback">{{ $errors->first('distributor_leader_name') }}</span>
        </div>
        <input type="hidden" value="{{ isset($distributor) ? ($distributor->distributor != null ? $distributor->distributor->id : null ) : null }}" id="fk_id_distributor" name="fk_id_distributor">
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="country" class="focused form-label">País</label>
            <select class="form-control" id="fk_id_country" name="fk_id_country">
                @foreach(\App\Models\Country::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($distributor) ? ($distributor->fk_id_country == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="bank_name" class="focused form-label">Nombre del banco</label>
            <input type="text" class="form-control" autocomplete="off" id="bank_name" name="bank_name" value="{{ isset($distributor) ? $distributor->bank_name : null}}">
            <span class="invalid-feedback">{{ $errors->first('bank_name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="bank_account_number" class="focused form-label">Número de cuenta bancaria</label>
            <input type="text" class="form-control" autocomplete="off" id="bank_account_number" name="bank_account_number" value="{{ isset($distributor) ? $distributor->bank_account_number : null}}">
            <span class="invalid-feedback">{{ $errors->first('bank_account_number') }}</span>
        </div>
    </div>
</div>
