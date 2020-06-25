<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($branch) ? 'Modificar sucursal' : 'Agregar sucursal'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($branch) ? route('admin_branch_update_post',['branchId' => $branch->id]) : route('admin_branch_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.branch._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($branch) ? 'Guardar' : 'Agregar sucursal'}}
            </button>
        </div>
    </form>
</div>
