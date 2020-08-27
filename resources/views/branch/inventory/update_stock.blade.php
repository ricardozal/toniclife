<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{trans('index.ms')}} {{$product->name}}</h4>
</div>
<div class="row">
    <form id="form-update" action="{{route('branch_inventory_update_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        <div class="row w-75">
            <div class="col-12">
                <div class="form-group form-select focused">
                    <label for="type" class="focused form-label">Movimiento</label>
                    <select class="form-control" id="type" name="type">
                        <option value="1"> Positivo </option>
                        <option value="0"> Negativo </option>
                    </select>
                </div>

            </div>
        </div>

        <div class="row w-75">
            <div class="col-12">
                <div class="form-group focused">
                    <label for="stock" class="focused form-label">Cantidad de ajuste</label>
                    <input type="number" min="1" class="form-control" id="stock" name="stock" value="" autocomplete="off">
                    <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
                </div>
            </div>
        </div>
        <input type="hidden" name="productId" value="{{$product->id}}">
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </div>
    </form>
</div>
