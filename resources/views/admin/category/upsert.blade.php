<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($category) ? 'Modificar categoria' : 'Agregar categoria'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($category) ? route('admin_category_update_post',['categoryId' => $category->id]) : route('admin_category_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.category._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($category) ? 'Guardar' : 'Guardar'}}
            </button>
        </div>
    </form>
</div>
