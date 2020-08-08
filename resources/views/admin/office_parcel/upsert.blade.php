<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($officeParcel) ? 'Modificar paquetería' : 'Agregar paquetería'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($officeParcel) ? route('admin_office_parcel_update_post',['officeParcelId' => $officeParcel->id]) : route('admin_office_parcel_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.office_parcel._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($officeParcel) ? 'Modificar' : 'Guardar'}}
            </button>
        </div>
    </form>
</div>
