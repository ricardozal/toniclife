<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">{{isset($product) ? 'Modificar producto' : 'Agregar producto'}}</h4>
</div>
<div class="row">
    <form id="form-upsert" action="{{isset($product) ? route('admin_product_update_post',['productId' => $product->id]) : route('admin_product_create_post')}}"
          class="d-flex flex-column align-items-center w-100"
          method="post">
        @csrf
        @include('admin.product._form')
        <div class="form-group text-center w-75">
            <button type="submit" class="btn btn-primary">
                {{isset($product) ? 'Guardar' : 'Agregar producto'}}
            </button>
        </div>
    </form>
</div>
