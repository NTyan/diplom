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
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['organization_id', 'plastic', 'price'];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    public function getOrganizationId(): int
    {
        return $this->organization_id;
    }

    public function setOrganizationId(int $organization_id): Price
    {
        $this->organization_id = $organization_id;
        return $this;
    }

    public function getPlastic(): string
    {
        return $this->plastic;
    }

    public function setPlastic(string $plastic): Price
    {
        $this->plastic = $plastic;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Price
    {
        $this->price = $price;
        return $this;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * fetch
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
