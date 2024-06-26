<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $image_url
 * @property float $distributor_price
 * @property float $points
 * @property int $active
 * @property int $fk_id_country
 * @property int|null $fk_id_category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Branch[] $branches
 * @property-read int|null $branches_count
 * @property-read \App\Models\Category|null $category
 * @property-read \App\Models\Country $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movement[] $movements
 * @property-read int|null $movements_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReorderRequest[] $reorderRequests
 * @property-read int|null $reorder_requests_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDistributorPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereFkIdCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereFkIdCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePoints($value)
 * @mixin \Eloquent
 * @property-read mixed $absolute_image_url
 * @property-read mixed $available_inventory
 * @property int $is_kit
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsKit($value)
 * @property-read mixed $price_with_tax
 */
class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;

    public $appends = [
        'absolute_image_url',
        'available_inventory',
        'price_with_tax'
    ];

    protected $fillable = [
        'code',
        'name',
        'distributor_price',
        'points',
        'fk_id_country'
    ];

    public function branches()
    {
        return $this->belongsToMany(
            Branch::class,
            'branch_has_products',
            'fk_id_product',
            'fk_id_branch'
        )->withPivot(['stock']);
    }

    public function country()
    {
        return $this->belongsTo(
            Country::class,
            'fk_id_country',
            'id'
        );
    }

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'fk_id_category',
            'id'
        );
    }

    public function movements()
    {
        return $this->hasMany(
            Movement::class,
            'fk_id_product',
            'id'
        );
    }

    public function orders()
    {
        return $this->belongsToMany(
            Order::class,
            'order_product',
            'fk_id_product',
            'fk_id_order'
        )->withPivot(['price','quantity']);
    }

    public function reorderRequests()
    {
        return $this->belongsToMany(
            ReorderRequest::class,
            'reorder_request_product',
            'fk_id_product',
            'fk_id_reorder_request'
        )->withPivot(['quantity']);
    }

    public function getAbsoluteImageUrlAttribute(){
        return asset($this->image_url);
    }

    public function getAvailableInventoryAttribute(){

        $inventory ="";

        if($this->branches->count() > 0){
            foreach ($this->branches as $branch){

                $inventory .= $branch->name.": ".$branch->pivot->stock." pieza(s). \n";

            }
        } else {
            $inventory = "Sin inventario disponible";
        }

        return $inventory;

    }

    public function getPriceWithTaxAttribute() {
        return $this->distributor_price + (($this->country->tax_percentage*0.01)*($this->distributor_price));
    }

}
