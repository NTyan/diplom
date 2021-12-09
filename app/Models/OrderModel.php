<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $order_id
 * @property int $width
 * @property int $height
 * @property int $volume
 * @property int $weight
 * @property string $color
 * @property string $plastic
 * @property int $count
 * @property int $price
 * @property Order $order
 */
class OrderModel extends Model
{

    public const PLASTIC = [
        'ABS', 'PLA', 'TPU', 'Neylon', 'PETG', 'FLEX'
    ];


    /**
     * @var array
     */
    protected $fillable = ['order_id', 'width', 'height', 'volume', 'weight', 'color', 'plastic', 'count', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
