<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $organization_id
 * @property string $plastic
 * @property int $price
 * @property Organization $organization
 */
class Price extends Model
{

    public const PLASTIC = [
        'ABS', 'PLA', 'TPU', 'Neylon', 'PETG', 'FLEX'
    ];
    /**
     * @var array
     */
    protected $fillable = ['organization_id', 'plastic', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
