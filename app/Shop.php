<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $img
 * @property string $name
 * @property string $tel
 * @property string $county
 * @property string $address
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class Shop extends Model
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
    protected $fillable = ['img', 'name', 'tel', 'county', 'address', 'sort', 'created_at', 'updated_at'];

}
