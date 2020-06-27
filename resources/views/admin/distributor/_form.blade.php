<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">ID Tonic Life</label>
            <input type="text" class="form-control" id="tonic_life_id" name="tonic_life_id" value="{{ isset($distributor) ? $distributor->tonic_life_id : null}}">
            <span class="invalid-feedback">{{ $errors->first('tonic_life_id') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($distributor) ? $distributor->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ isset($distributor) ? $distributor->email : null}}">
            <span class="invalid-feedback">{{ $errors->first('email') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" value="">
            <span class="invalid-feedback">{{ $errors->first('password') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
            <span class="invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group">
            <label for="distributor_leader_name">Distribuidor líder</label>
            <input type="text" class="form-control {{ $errors->has('distributor_leader_name') ? ' is-invalid' : '' }}" id="distributor_leader_name" name="distributor_leader_name" value="{{ isset($distributor) ? ($distributor->distributor != null ? $distributor->distributor->name : null ) : null }}">
            <span class="invalid-feedback">{{ $errors->first('distributor_leader_name') }}</span>
        </div>
        <input type="hidden" value="{{ isset($distributor) ? ($distributor->distributor != null ? $distributor->distributor->id : null ) : null }}" id="fk_id_distributor" name="fk_id_distributor">
    </div>
</div>
