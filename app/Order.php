<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $order_no
 * @property string $Recipient_name
 * @property string $Recipient_phone
 * @property string $dealer_address
 * @property string $payment_status
 * @property string $totalPrice
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
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
    protected $fillable = ['order_no', 'Recipient_name', 'Recipient_phone', 'dealer_address', 'payment_status', 'totalPrice', 'created_at', 'updated_at'];


    public function order_details()
    {
        return $this->hasMany('App\OrderDetail');
    }


}
