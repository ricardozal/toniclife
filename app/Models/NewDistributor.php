<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NewDistributor
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $marital_status
 * @property string $birthday
 * @property string $birth_place
 * @property string $nationality
 * @property string $rfc_or_itin
 * @property string $curp_or_ssn
 * @property string $phone_1
 * @property string $phone_2
 * @property string|null $no_official_identification
 * @property int $fk_id_address
 * @property int $fk_id_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereCurpOrSsn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereFkIdAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereFkIdOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereNoOfficialIdentification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereRfcOrItin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NewDistributor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class NewDistributor extends Model
{
    protected $table = 'new_distributor';


    public function order(){
        return $this->belongsTo(
            Order::class,
            'fk_id_order',
            'id'
        );
    }
}
