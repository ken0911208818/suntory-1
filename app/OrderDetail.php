<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $order_id
 * @property string $product_id
 * @property string $qty
 * @property string $price
 * @property string $created_at
 * @property string $updated_at
 */
class OrderDetail extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasMany('App\LiqueurProduct','id','product_id')->orderby('sort', 'desc');
    }

}
