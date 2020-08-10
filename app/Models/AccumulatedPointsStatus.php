<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccumulatedPointsStatus
 *
 * @property int $id
 * @property int $limit
 * @property int $with_points
 * @property int $fk_id_country
 * @property int $fk_id_traffic_lights
 * @property-read \App\Models\TrafficLights $trafficLight
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus whereFkIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus whereFkIdTrafficLights($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus whereLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccumulatedPointsStatus whereWithPoints($value)
 * @mixin \Eloquent
 */
class AccumulatedPointsStatus extends Model
{
    protected $table = 'accumulated_points_status';

    public function trafficLight(){

        return $this->belongsTo(
            TrafficLights::class,
            'fk_id_traffic_lights',
            'id'
        );

    }

    public static function getPointHistoryStatus($distributorId){

        /** @var Distributor $distributor */
        $distributor = Distributor::find($distributorId);

        $status = 0;

        if($distributor->fk_id_country == Country::USA){

            $amount = $distributor->currentPoints[0]->accumulated_money;

            if($amount >= 0 && $amount < 70){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::WHITE)->first()->id;
            } elseif ($amount >= 70 && $amount < 100){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::RED)->first()->id;
            } elseif ($amount >= 100 && $amount < 150){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::YELLOW)->first()->id;
            } elseif ($amount >= 150 && $amount < 300){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->id;
            } elseif ($amount >= 300 && $amount < 450){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::LIGHT_BLUE)->first()->id;
            } elseif ($amount >= 450){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::STRONG_BLUE)->first()->id;
            }

        } elseif ($distributor->fk_id_country == Country::MEX){
            $amount = $distributor->currentPoints[0]->accumulated_points;

            if($amount >= 0 && $amount < 2000){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::WHITE)->first()->id;
            } elseif ($amount >= 2000 && $amount < 2800){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::RED)->first()->id;
            } elseif ($amount >= 2800 && $amount < 3300){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::YELLOW)->first()->id;
            } elseif ($amount >= 3300 && $amount < 4000){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::GREEN)->first()->id;
            } elseif ($amount >= 4000 && $amount < 6000){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::LIGHT_BLUE)->first()->id;
            } elseif ($amount >= 6000){
                $status = AccumulatedPointsStatus::where('fk_id_country', Country::USA)->where('fk_id_traffic_lights', TrafficLights::STRONG_BLUE)->first()->id;
            }
        }

        return $status;

    }

}
