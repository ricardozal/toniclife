<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Corporate
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Corporate wherePhone($value)
 * @mixin \Eloquent
 */
class Corporate extends Model
{
    protected $table = 'corporate_data';
    use Notifiable;

    public function routeNotificationForWhatsApp()
    {
        return $this->phone;
    }

}
