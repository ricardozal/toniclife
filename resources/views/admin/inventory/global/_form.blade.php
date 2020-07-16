<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="fk_id_branch" class="focused form-label">Por favor, elija la sucursal de origen</label>
            <select class="form-control " id="fk_id_branch">
                <option value="0">-- Elegir sucursal --</option>
                @foreach(\App\Models\Branch::asMap() as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="fk_id_branchDestination" class="focused form-label">Por favor, elija la sucursal de destino</label>
            <select class="form-control " id="fk_id_branchDestination">
                <option value="0">-- Elegir sucursal --</option>
                @foreach(\App\Models\Branch::asMap() as $id => $name)
                    <option value="{{$id}}">{{$name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="stock" class="focused form-label">Cantidad que se va a transpasar</label>
            <input type="number" min="1" class="form-control" id="stock" name="stock" value="" autocomplete="off">
            <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="comment" class="focused form-label">Comentario</label>
            <input type="text" class="form-control" autocomplete="off" id="comment" name="comment" value="">
            <span class="invalid-feedback">{{ $errors->first('comment') }}</span>
        </div>
    </div>
</div>
