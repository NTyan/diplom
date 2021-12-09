<?php

    namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $organization_id
 * @property string $number
 * @property string $create_at
 * @property string $update_at
 * @property string $status
 * @property boolean $is_paid
 * @property string $deleted_at
 * @property int $sum
 * @property User $user
 * @property Organization $organization
 * @property OrderModel[] $orderModels
 */
class Order extends Model
{

    public const STATUS = [
        'processing' => 'В обработке',
        'confirmed' => 'Подтвержден',
        'transit' => 'В пути',
        'canceled' => 'Отменен',
        'completed' => 'Завершен'
    ];


    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'organization_id', 'number', 'create_at', 'update_at', 'status', 'is_paid', 'deleted_at', 'sum'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderModels()
    {
        return $this->hasMany('App\Models\OrderModel');
    }
}
