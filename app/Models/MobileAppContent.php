<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MobileAppContent
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $key
 * @property string|null $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MobileAppContent whereUrl($value)
 * @mixin \Eloquent
 * @property-read mixed $absolute_url
 */
class MobileAppContent extends Model
{
    protected $table = 'mobile_app_content';
    public $timestamps = false;

    protected $appends = ['absolute_url'];

    public function getAbsoluteUrlAttribute(){

        return asset($this->url);

    }
}
