<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Agregar producto</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{route('branch_inventory_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        <div class="row w-75">
            <div class="col-12">
                <div class="form-group focused">
                    <label for="name" class="focused form-label">Nombre del producto</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="" autocomplete="off">
                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                </div>
                <input type="hidden" value="" id="fk_id_product" name="fk_id_product">
            </div>
        </div>

        <div class="row w-75">
            <div class="col-12">
                <div class="form-group focused">
                    <label for="stock" class="focused form-label">Stock</label>
                    <input type="number" min="1" class="form-control" id="stock" name="stock" value="" autocomplete="off">
                    <span class="invalid-feedback">{{ $errors->first('stock') }}</span>
                </div>
            </div>
        </div>
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Agregar producto
            </button>
        </div>
    </form>
</div>
