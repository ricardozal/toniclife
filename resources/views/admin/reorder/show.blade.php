@php
    /* @var $reorder ReorderRequest*/use App\Models\ReorderRequest;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Reorder {{$reorder->id}}</h4>
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

            </div>
        </div>




    </div>
</div>


