<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Producto {{$product->name}}</h4>
</div>

<div class="row w-75 mx-auto">
    <div class="col-12 px-md-5 py-1">
        <div class="row">
            <div class="col-6">
                <p><strong>Código: </strong> {{$product->code}}</p>
            </div>
            <div class="col-6">
                <p><strong>Catálogo: </strong> {{$product->country->name}}</p>
            </div>
        </div>
        <div class="row w-75 text-center mx-auto">
            <table class="table table-borderless color-light-dark t-resp">
                <thead class="border-bottom">
                <tr>
                    <th class="text-center" scope="col">Sucursal</th>
                    <th class="text-center" scope="col">Stock en sucursal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($branches as $branch)
                    <tr>
                        <th class="text-center">
                            {{$branch->name}}
                        </th>
                        <th class="text-center">
                            {{$branch->pivot->stock}}
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
