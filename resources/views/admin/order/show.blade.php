@php
    /* @var $order Order*/use App\Models\Order;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Orden {{$order->id}}</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-6">
                <p class="font-weight-bold">Orden No.{{$order->id}}</p>
                <p><strong>Distribuidor: </strong>{{$order->distributor->name}}</p>
                <p><strong>ID Tonic Life: </strong>{{$order->distributor->tonic_life_id}}</p>
            </div>
            <div class="col-6 text-right">
                <p>{{$order->created_at->format('d-m-Y')}}</p>
                <p>Estado: <em>{{$order->status->name}}</em></p>
            </div>
        </div>
        <div class="row">
            <table class="table table-borderless color-light-dark table-responsive">
                <thead class="border-bottom">
                <tr>
                    <th class="text-center" scope="col">Producto</th>
                    <th class="text-center" scope="col">Puntos</th>
                    <th class="text-center" scope="col">Precio distribuidor + Impuesto</th>
                    <th class="text-center" scope="col">Cantidad</th>
                    <th class="text-center" scope="col">Precio total</th>
                    <th class="text-center" scope="col">Puntos acumulados</th>

                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <th class="text-center">
                            {{$product->name}}
                        </th>
                        <th class="text-center">
                            {{$product->points}}
                        </th>
                        <th class="text-center">
                            ${{number_format(($product->country->tax_percentage*0.01)*($product->distributor_price)+$product->distributor_price,2)}}
                        </th>
                        <th class="text-center">
                            {{$product->pivot->quantity}}
                        </th>
                        <th class="text-center">
                            ${{number_format($product->pivot->price,2)}}
                        </th>
                        <th class="text-center">
                            {{$product->points*$product->pivot->quantity}}
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="row" >
            <div class="col-12 border-top ">
                <p class="py-2">
                    <strong>{{$order->shippingAddress != null ? 'Dirección de envío' : 'Recoger en sucursal'}}: </strong> {{$order->shippingAddress != null ? $order->shippingAddress->FullAddress : $order->branch->name }}
                </p>
            </div>
        </div>
        <div class="row" >
            <div class="col-12 border-top ">
                <p class="py-2">
                    Método de pago: <strong>{{$order->paymentMethod->name }}</strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 border-top text-right">
                <p class="pt-3">
                    <strong>Envio: </strong> <span>${{number_format($order->shipping_price,2)}}</span>
                </p>
                <p>
                    <strong>Impuestos: </strong> <span>${{number_format($order->total_taxes,2)}}</span>
                </p>
                <h4><strong>Total: </strong>${{number_format($order->total_price,2)}}</h4>
                <h6><strong>Puntos acumulados: </strong>{{$order->total_accumulated_points}}</h6>
            </div>
        </div>
    </div>
</div>


