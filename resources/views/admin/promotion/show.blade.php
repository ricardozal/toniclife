<div class="d-flex flex-column align-items-center mb-5">
<h4 class="text-header mt-2">Promoción {{$promotion->name}}</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-6">
                <p class="font-weight-bold">Promoción No.{{$promotion->id}}</p>
                <p><strong>Nombre: </strong>{{$promotion->name}}</p>
                <p><strong>Descripción: </strong>{{$promotion->description}}</p>
                <p><strong>Monto mínimo: </strong>{{$promotion->min_amount}}</p>
                <p><strong>Fecha de inicio: </strong>{{$promotion->begin_date}}</p>
                <p><strong>Fecha de expiración: </strong>{{$promotion->expiration_date}}</p>





            </div>
            <div class="col-6 text-right">

                <p><strong> Fecha de cración </strong><br/>{{$promotion->created_at->format('d-m-Y')}}</p>


            </div>
        </div>







    </div>
</div>


