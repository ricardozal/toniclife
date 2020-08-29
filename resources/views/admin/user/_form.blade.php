<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="name"  class="focused form-label">Nombre</label>
            <input type="text" class="form-control" autocomplete="off" id="name" name="name" value="{{ isset($user) ? $user->name : null}}">
            <span class="invalid-feedback">{{ $errors->first('name') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="email" class="focused form-label">Correo electrónico</label>
            <input type="email" class="form-control" autocomplete="off" id="email" name="email" value="{{ isset($user) ? $user->email : null}}">
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
        <div class="form-group form-select focused">
            <label for="fk_id_role" class="focused form-label">Role</label>
            <select class="form-control" id="fk_id_role" name="fk_id_role">
                @foreach(\App\Models\Role::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($user) ? ($user->fk_id_role == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75 branch d-none">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="fk_id_branch" class="focused form-label">Sucursal</label>
            <select class="form-control" id="fk_id_branch" name="fk_id_branch">
                <option value="0">-- Elegir sucursal --</option>
                @foreach(\App\Models\Branch::asMap() as $id => $name)
                    <option value="{{$id}}" {{isset($user) ? ($user->fk_id_branch == $id ? 'selected' : '') : ''}}>{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

