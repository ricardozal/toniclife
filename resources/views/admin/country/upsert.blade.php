<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($country) ? 'Modificar país' : 'Agregar país'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($country) ? route('admin_country_update_post',['countryId' => $country->id]) : route('admin_country_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.country._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($country) ? 'Guardar' : 'Agregar país'}}
            </button>
        </div>
    </form>
</div>
