@php
    /* @var $newDistributor NewDistributor*/use App\Models\NewDistributor;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Nuevo distribuidor: {{$newDistributor->name}}</h4>
</div>

<div class="d-flex justify-content-center flex-column w-75 mx-auto">
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-3">Datos personales</h3>
                </div>
            </div>
            <p><strong>Correo electrónico: </strong>{{$newDistributor->email}}</p>
            <p><strong>Estado civil: </strong>{{$newDistributor->marital_status}}</p>
            <p><strong>Fecha de nacimiento: </strong>{{$newDistributor->birthday}}</p>
            <p><strong>Lugar de nacimiento: </strong>{{$newDistributor->birth_place}}</p>
            <p><strong>Nacionalidad: </strong>{{$newDistributor->nationality}}</p>
            <p><strong>{{$newDistributor->address->fk_id_country == 1 ? 'RFC: ' : 'ITIN: '}} </strong>{{$newDistributor->rfc_or_itin}}</p>
            <p><strong>{{$newDistributor->address->fk_id_country == 1 ? 'CURP: ' : 'SSN: '}} </strong>{{$newDistributor->curp_or_ssn}}</p>
            <p><strong>Teléfono: </strong>{{$newDistributor->phone_1}}</p>
            <p><strong>Fecha de inscripción: </strong>{{$newDistributor->created_at}}</p>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-3">Datos de domicilio: </h3>
                </div>
            </div>
            <p><strong>Calle: </strong>{{$newDistributor->address->street}}</p>
            <p><strong>Código postal: </strong>{{$newDistributor->address->zip_code}}</p>
            <p><strong>Número exterior: </strong>{{$newDistributor->address->ext_num}}</p>
            <p><strong>Número interior: </strong>{{$newDistributor->address->int_num}}</p>
            <p><strong>Colonia: </strong>{{$newDistributor->address->colony}}</p>
            <p><strong>Ciudad: </strong>{{$newDistributor->address->city}}</p>
            <p><strong>Estado: </strong>{{$newDistributor->address->state}}</p>
            <p><strong>País: </strong>{{$newDistributor->address->country->name}}</p>
            <p><strong>Referencias: </strong>{{$newDistributor->address->references}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="mb-3">Datos bancarios</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <p><strong>Nombre del banco: </strong>{{$newDistributor->dataBank->bank_name}}</p>
                    <p><strong>Nombre de propietario de cuenta: </strong>{{$newDistributor->dataBank->account_name}}</p>
                </div>
                <div class="col-12 col-md-6">
                    <p><strong>Número de cuenta: </strong>{{$newDistributor->dataBank->bank_account_number}}</p>
                    <p><strong>{{$newDistributor->address->fk_id_country == 1 ? 'CLABE: ' : 'Routing Bank: '}} </strong>{{$newDistributor->dataBank->clabe_routing_bank}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
