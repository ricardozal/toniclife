<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DataBank
 *
 * @property int $id
 * @property string $bank_name
 * @property string $account_name
 * @property string $bank_account_number
 * @property string $clabe_routing_bank
 * @property int $fk_id_new_distributor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereBankAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereClabeRoutingBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereFkIdNewDistributor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DataBank whereId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\NewDistributor $newDistributor
 */
class DataBank extends Model
{
    protected $table = 'data_bank';

    public function newDistributor()
    {
        return $this->belongsTo(
            NewDistributor::class,
            'fk_id_new_distributor',
            'id'
        );
    }

}
