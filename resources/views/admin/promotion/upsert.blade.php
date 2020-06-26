<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($promotion) ? 'Modificar promoción' : 'Agregar promoción'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($promotion) ? route('admin_promotion_update_post',['promotionId' => $promotion->id]) : route('admin_promotion_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.promotion._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($promotion) ? 'Guardar' : 'Guardar'}}
            </button>
        </div>
    </form>
</div>
