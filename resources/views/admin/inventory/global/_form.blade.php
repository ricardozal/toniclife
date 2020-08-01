<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="fk_id_branch" class="focused form-label">Por favor, elija la sucursal de origen</label>
            <select class="form-control " id="fk_id_branch" name="fk_id_branch">
                <option value="">-- Elegir sucursal --</option>
                @foreach($originBranches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group form-select focused">
            <label for="fk_id_branchDestination" class="focused form-label">Por favor, elija la sucursal de destino</label>
            <select class="form-control " id="fk_id_branchDestination" name="fk_id_branchDestination">
                <option value="">-- Elegir sucursal --</option>
                @foreach($destinationBranches as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row w-75">
    <div class="col-12">
        <div class="form-group focused">
            <label for="stock" class="focused form-label">Cantidad a traspasar</label>
            <input type="number" min="1" class="form-control" id="stock" name="stock" value="" autocomplete="off">
            <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
        </div>
    </div>
</div>
