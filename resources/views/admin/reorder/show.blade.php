@php
    /* @var $reorder ReorderRequest*/use App\Models\ReorderRequest;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Reorden {{$reorder->id}}</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-6">
                <p class="font-weight-bold">Reorden No.{{$reorder->id}}</p>
                <p><strong>Distribuidor: </strong>{{$reorder->distributor->name}}</p>

                <p><strong>ID Tonic Life: </strong>{{$reorder->distributor->tonic_life_id}}</p>
            </div>
            <div class="col-6 text-right">

                <p>{{$reorder->created_at->format('d-m-Y')}}</p>
                <p>Estado de envio: <em>{{$reorder->status->name}}</em></p>

            </div>
        </div>

        <div class="row">
            <table class="table table-borderless color-light-dark table-responsive">
                <thead class="border-bottom">
                <tr>
                    <th class="text-center" scope="col">Código</th>
                    <th class="text-center" scope="col">Nombre del roducto</th>

                    <th class="text-center" scope="col">Cantidad</th>


                </tr>
                </thead>
                <tbody>
                @foreach($reorder->products as $product)
                    <tr>
                        <th class="text-center">
                            {{$product->code}}
                        </th>
                        <th class="text-center">
                            {{$product->code}}
                        </th>
                        <th class="text-center">
                            {{$product->pivot->quantity}}
                        </th>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>





    </div>
</div>


