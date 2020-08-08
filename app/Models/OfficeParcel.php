<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OfficeParcel
 *
 * @property int $id
 * @property string $name
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OfficeParcel whereName($value)
 * @mixin \Eloquent
 */
class OfficeParcel extends Model
{
    protected $table = 'office_parcel';
    public $timestamps = false;
    protected $fillable = ['name'];

    public static function asMap()
    {
        return self::whereActive(true)->pluck('name', 'id');
    }

}
