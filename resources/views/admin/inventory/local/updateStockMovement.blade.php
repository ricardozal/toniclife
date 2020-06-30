<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Modificar stock</h4>
</div>
<div class="row">
    <form id="form-update" action="{{route('admin_inventory_local_update_post',['branchId' => $branchId])}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.inventory.local._formSM')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                Guardar
            </button>
        </div>
    </form>
</div>
