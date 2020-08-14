@php
    /* @var $distributor Distributor*/use \App\Models\Distributor;
@endphp

<div class="d-flex flex-column align-items-center mb-5">
    <h4 class="text-header mt-2">Historial de puntos</h4>
</div>

<div class="row">
    <div class="col-12 p-md-5 py-1">
        <div class="row">
            <div class="col-12 col-md-4">
                <p><strong>Distribuidor: </strong>{{$distributor->name}}</p>
                <p><strong>ID Tonic Life: </strong>{{$distributor->tonic_life_id}}</p>
            </div>
            <div class="col-12 col-md-8 text-right">
                <p><strong>Periodo actual: </strong>{{\App\Services\DateFormatterService::fullDatetime(\Carbon\Carbon::parse($distributor->currentPoints[0]->begin_period)).' al '.\App\Services\DateFormatterService::fullDatetime(\Carbon\Carbon::parse($distributor->currentPoints[0]->end_period))}}</p>
            </div>
        </div>
        <div class="row">
            <table class="table table-borderless color-light-dark t-resp">
                <thead class="border-bottom">
                <tr>
                    <th class="text-center" scope="col">Fecha inicio</th>
                    <th class="text-center" scope="col">Fecha fin</th>
                    <th class="text-center" scope="col">Puntos acumulados</th>
                    <th class="text-center" scope="col">Dinero acumulado</th>
                    <th class="text-center" scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($distributor->accumulatedPointsHistory as $points)
                    <tr>
                        <th class="text-center">
                            {{\Carbon\Carbon::parse($points->begin_period)->format('d-m-Y')}}
                        </th>
                        <th class="text-center">
                            {{\Carbon\Carbon::parse($points->end_period)->format('d-m-Y')}}
                        </th>
                        <th class="text-center">
                            {{number_format($points->accumulated_points,2)}}
                        </th>
                        <th class="text-center">
                            {{number_format($points->accumulated_money,2)}}
                        </th>
                        <th class="text-center">
                            <div style="height: 30px; width: 30px; border-radius: 200px; background-color: {{$points->accumulatedPointsStatus->trafficLight->color}}"></div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-12 border-top text-right pt-3">
                <h4><strong>Total puntos historico: </strong>{{number_format($distributor->accumulatedPointsHistory()->sum('accumulated_points'),2)}}</h4>
                <h4><strong>Total dinero historico: </strong>{{number_format($distributor->accumulatedPointsHistory()->sum('accumulated_money'),2)}}</h4>
            </div>
        </div>
    </div>
</div>
