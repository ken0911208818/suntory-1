<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $liqueur_id
 * @property string $img
 * @property string $content
 * @property string $title
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class LiqueurMethod extends Model
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
    protected $fillable = ['liqueur_id', 'img', 'content', 'title', 'sort', 'created_at', 'updated_at'];

    public function liqueur()
    {
        return $this->belongsTo('App\Liqueur', 'liqueur_id', 'id')->orderBy('sort', 'desc');
    }
}
