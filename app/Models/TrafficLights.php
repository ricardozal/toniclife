<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TrafficLights
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrafficLights whereName($value)
 * @mixin \Eloquent
 */
class TrafficLights extends Model
{
    protected $table = 'traffic_lights';

    const WHITE = 1;
    const YELLOW = 2;
    const RED = 3;
    const GREEN = 4;
    const LIGHT_BLUE = 5;
    const STRONG_BLUE = 6;
}
