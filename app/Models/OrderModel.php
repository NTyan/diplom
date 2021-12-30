<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property integer $order_id
 * @property int $width
 * @property int $height
 * @property int $length
 * @property int $volume
 * @property int $weight
 * @property string $color
 * @property string $plastic
 * @property int $count
 * @property int $price
 * @property int $filling
 * @property int $area
 * @property Order $order
 */
class OrderModel extends Model
{

    public const PLASTIC = [
        'ABS', 'PLA', 'TPU', 'Neylon', 'PETG', 'FLEX'
    ];

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['order_id', 'title', 'width', 'height', 'length', 'volume', 'weight', 'color', 'plastic', 'count', 'price', 'filling', 'area'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): OrderModel
    {
        $this->title = $title;
        return $this;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): OrderModel
    {
        $this->order_id = $order_id;
        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): OrderModel
    {
        $this->width = $width;
        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): OrderModel
    {
        $this->height = $height;
        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): OrderModel
    {
        $this->length = $length;
        return $this;
    }


    public function getVolume(): int
    {
        return $this->volume;
    }

    public function setVolume(int $volume): OrderModel
    {
        $this->volume = $volume;
        return $this;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): OrderModel
    {
        $this->weight = $weight;
        return $this;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function setColor(string $color): OrderModel
    {
        $this->color = $color;
        return $this;
    }

    public function getPlastic(): string
    {
        return $this->plastic;
    }

    public function setPlastic(string $plastic): OrderModel
    {
        $this->plastic = $plastic;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): OrderModel
    {
        $this->count = $count;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): OrderModel
    {
        $this->price = $price;
        return $this;
    }

    public function getFilling(): int
    {
        return $this->filling;
    }

    public function setFilling(int $filling): OrderModel
    {
        $this->filling = $filling;
        return $this;
    }

    public function getArea(): int
    {
        return $this->area;
    }

    public function setArea(int $area): OrderModel
    {
        $this->area = $area;
        return $this;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }



}
