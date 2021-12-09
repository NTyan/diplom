<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $type
 * @property string $jur_address
 * @property string $inn
 * @property string $kpp
 * @property string $ogrn
 * @property string $payment_account
 * @property string $deleted_at
 * @property User $user
 * @property Order[] $orders
 * @property Price[] $prices
 */
class Organization extends Model
{
    use SoftDeletes;

    public const TYPES = [
        'ip' => 'ИП',
        'jur' => 'Юридическое лицо'
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
    protected $fillable = ['user_id', 'name', 'type', 'jur_address', 'inn', 'kpp', 'ogrn', 'payment_account'];

    protected $dates = ['deleted_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany('App\Models\Price');
    }

}
