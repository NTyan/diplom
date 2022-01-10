<?php

    namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $organization_id
 * @property string $number
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property boolean $is_paid
 * @property string $deleted_at
 * @property string $comment
 * @property int $sum
 * @property string $date_of_receiving
 * @property User $user
 * @property Organization $organization
 * @property OrderModel[] $orderModels
 * @method static find(mixed $order_id)
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

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'organization_id', 'number', 'created_at', 'updated_at', 'status', 'is_paid', 'deleted_at', 'sum', 'comment', 'date_of_receiving'];


    protected $dates = ['date_of_receiving'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): Order
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getOrganizationId(): int
    {
        return $this->organization_id;
    }

    public function setOrganizationId(int $organization_id): Order
    {
        $this->organization_id = $organization_id;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): Order
    {
        $this->number = $number;
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

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatusConfirmed(): Order
    {
        $this->status = "confirmed";
        return $this;
    }

    public function setStatusProcessing(): Order
    {
        $this->status = "processing";
        return $this;
    }

    public function setStatusTransit(): Order
    {
        $this->status = "transit";
        return $this;
    }

    public function setStatusCanceled(): Order
    {
        $this->status = "canceled";
        return $this;
    }

    public function setStatusCompleted(): Order
    {
        $this->status = "completed";
        return $this;
    }

    public function isIsPaid(): bool
    {
        return $this->is_paid;
    }

    public function setIsPaid(bool $is_paid): Order
    {
        $this->is_paid = $is_paid;
        return $this;
    }

    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): Order
    {
        $this->comment = $comment;
        return $this;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function setSum(int $sum): Order
    {
        $this->sum = $sum;
        return $this;
    }

    public function getDateOfReceiving(): string
    {
        return $this->date_of_receiving;
    }

    public function setDateOfReceiving(?string $date_of_receiving): Order
    {
        $this->date_of_receiving = $date_of_receiving;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getOrganization(): Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): Order
    {
        $this->organization = $organization;
        return $this;
    }

    public function getOrderModels(): array
    {
        return $this->orderModels;
    }

    public function setOrderModels(array $orderModels): Order
    {
        $this->orderModels = $orderModels;
        return $this;
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
