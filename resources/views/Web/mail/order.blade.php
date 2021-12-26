<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>GJana</title>
    <!-- Style sheets -->
    <style>
        html, body{
            margin: 0;
            padding: 10px;
            background-color: #F7F7F7;
            font-family: 'Montserrat';
        }
    </style>
</head>
<body>
    @php
        /* @var $order Order*/use App\Models\Order;
    @endphp
    <table style="width: 100%;">
        <tr>
            <td>
                <p style="font-weight: bold;">Orden No.{{$order->id}}</p>
                <p><b>Distribuidor: </b>{{$order->distributor->name}}</p>
                <p><b>ID Tonic Life: </b>{{$order->distributor->tonic_life_id}}</p>
            </td>
            <td>
                <p>{{$order->created_at->format('d-m-Y')}}</p>
                <p>Estado: <em>{{$order->status->name}}</em></p>
            </td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: 30px; overflow-x: scroll;">
        <tr>
            <th style="text-align: center;">Producto</th>
            <th style="text-align: center;">Puntos</th>
            <th style="text-align: center;">Precio distribuidor + Impuesto</th>
            <th style="text-align: center;">Cantidad</th>
            <th style="text-align: center;">Precio total</th>
            <th style="text-align: center;">Puntos acumulados</th>
        </tr>
        @foreach($order->products as $product)
        <tr>
            <td style="text-align: center;">
                {{$product->name}}
            </td>
            <td style="text-align: center;">
                {{$product->points}}
            </td>
            <td style="text-align: center;">
                ${{number_format(($product->country->tax_percentage*0.01)*($product->distributor_price)+$product->distributor_price,2)}}
            </td>
            <td style="text-align: center;">
                {{$product->pivot->quantity}}
            </td>
            <td style="text-align: center;">
                ${{number_format($product->pivot->price,2)}}
            </td>
            <td style="text-align: center;">
                {{$product->points*$product->pivot->quantity}}
            </td>
        </tr>
        @endforeach
    </table>
    <table style="width: 100%; margin-top: 30px;">
        <tr>
            <td>
                <p>
                    Información para pago: <br><br>
                    Nombre de banco: {{$order->distributor->bank_name}} <br>
                    Nombre de propietario: {{$order->distributor->bank_owner_name}} <br>
                    Número de cuenta: {{$order->distributor->bank_account_number}}
                </p>
            </td>
        </tr>
    </table>
    @isset($distributors)
    <table style="width: 100%; margin-top: 30px;">
        @foreach($distributors as $distributor)
        <tr>
            <td>
                <p>
                    Nombre: <b>{{$distributor->name }}</b>
                </p>
            </td>
            <td>
                <p>
                    Puntos acumulados: <b>{{ \App\Models\ExternalGainedPoint::whereFkIdPointHistory($distributor->currentPoints->first()->id)->where('fk_id_order',$order->id)->first()->points }}</b>
                </p>
            </td>
        </tr>
        @endforeach
        <tr>
            <td>
                <p>
                    Distribuidor que realizó compra: <b>{{$order->distributor->name }}</b>
                </p>
            </td>
            <td>
                <p>
                    Puntos acumulados: <b>{{$pointsForDistributor}}</b>
                </p>
            </td>
        </tr>
    </table>
    @endif
    <table style="width: 100%; text-align: right;">
        <tr>
            <td>
                <p class="pt-3">
                    <b>Envio: </b> <span>${{number_format($order->shipping_price,2)}}</span>
                </p>
                <p>
                    <b>Impuestos: </b> <span>${{number_format($order->total_taxes,2)}}</span>
                </p>
                <h4><b>Total: </b>${{number_format($order->total_price + $order->total_taxes,2)}}</h4>
                <h4><b>Puntos acumulados: </b>{{$order->total_accumulated_points}}</h4>
            </td>
        </tr>
    </table>
</body>
</html>
