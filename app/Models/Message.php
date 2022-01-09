<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $order_id
 * @property int $sender_id
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 * @property Order $order
 */
class Message extends Model
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
    protected $fillable = ['order_id', 'sender_id', 'message', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): Message
    {
        $this->order_id = $order_id;
        return $this;
    }

    public function getSenderId(): int
    {
        return $this->sender_id;
    }

    public function setSenderId(int $sender_id): Message
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }


    public function setMessage(string $message): Message
    {
        $this->message = $message;
        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }


    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }


}
