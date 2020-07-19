<div class="d-flex flex-column align-items-center justify-content-center text-center mb-2">
    <h4 class="text-header mt-2">{{$promotion->name}}</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-12 col-md-6">
                <p class="font-weight-bold">Promoción No.{{$promotion->id}}</p>
            </div>
            <div class="col-12 col-md-6 text-right">
                <p><strong> Fecha de creación </strong><br/>{{$promotion->created_at->format('d-m-Y')}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><strong>Nombre: </strong>{{$promotion->name}}</p>
                <p><strong>Descripción: </strong>{{$promotion->description}}</p>
                <p><strong>Monto mínimo: </strong>{{$promotion->with_points ? $promotion->min_amount.' puntos' : '$'.number_format($promotion->min_amount,2)}}</p>
                <p><strong>Fecha de inicio: </strong>{{$promotion->begin_date}}</p>
                <p><strong>Fecha de expiración: </strong>{{$promotion->expiration_date}}</p>
                <p><strong>País: </strong>{{$promotion->country->name}}</p>
                <p><strong>{{$promotion->is_accumulative ? 'Promoción con monto mínimo acumulativo' : 'Promoción en una sola compra'}}</strong></p>
            </div>
        </div>
    </div>
</div>


