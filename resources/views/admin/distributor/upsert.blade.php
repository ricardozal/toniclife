<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($user) ? 'Modificar distribuidor' : 'Agregar distribuidor'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($user) ? route('admin_distributor_update_post',['userId' => $user->id]) : route('admin_distributor_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.distributor._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($user) ? 'Guardar' : 'Agregar distribuidor'}}
            </button>
        </div>
    </form>
</div>
