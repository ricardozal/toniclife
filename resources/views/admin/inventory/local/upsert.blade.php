<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($inventoryL) ? 'Modificar stock' : 'Agregar producto'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($inventoryL) ? route('admin_inventory_local_update_post',['branchId' => $branch->id]) : route('admin_inventory_local_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.inventory.local._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($inventoryL) ? 'Guardar' : 'Agregar producto'}}
            </button>
        </div>
    </form>
</div>
