@php
    /* @var $newDistributor NewDistributor*/use App\Models\NewDistributor;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Nombre {{$newDistributor->name}}</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-6">
                <p><strong>Correo electrónico: </strong>{{$newDistributor->email}}</p>
                <p><strong>Estado civil: </strong>{{$newDistributor->marital_status}}</p>
                <p><strong>Fecha de nacimiento: </strong>{{$newDistributor->birthday}}</p>
                <p><strong>Lugar de nacimiento: </strong>{{$newDistributor->birth_place}}</p>
                <p><strong>Nacionalidad: </strong>{{$newDistributor->nationality}}</p>
                <p><strong>RFC o ITIN: </strong>{{$newDistributor->rfc_or_itin}}</p>
                <p><strong>CURP o SSN: </strong>{{$newDistributor->curp_or_ssn}}</p>
                <p><strong>Teléfono: </strong>{{$newDistributor->phone_1}}</p>
                <p><strong>Fecha de inscripción: </strong>{{$newDistributor->created_at}}</p>
            </div>
    </div>
</div>
