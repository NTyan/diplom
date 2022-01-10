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
 * @property string $description
 * @property string $email
 * @property string $phone_number
 * @property Order[] $orders
 * @property Price[] $prices
 * @method static find($executor_id)
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
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'type', 'jur_address', 'inn', 'kpp', 'ogrn', 'payment_account', 'description', 'email', 'phone_number'];

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


    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): Organization
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Organization
    {
        $this->name = $name;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Organization
    {
        $this->type = $type;
        return $this;
    }

    public function getJurAddress(): string
    {
        return $this->jur_address;
    }

    public function setJurAddress(string $jur_address): Organization
    {
        $this->jur_address = $jur_address;
        return $this;
    }

    public function getInn(): string
    {
        return $this->inn;
    }

    public function setInn(string $inn): Organization
    {
        $this->inn = $inn;
        return $this;
    }

    public function getKpp(): string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): Organization
    {
        $this->kpp = $kpp;
        return $this;
    }

    public function getOgrn(): string
    {
        return $this->ogrn;
    }

    public function setOgrn(string $ogrn): Organization
    {
        $this->ogrn = $ogrn;
        return $this;
    }

    public function getPaymentAccount(): string
    {
        return $this->payment_account;
    }

    public function setPaymentAccount(string $payment_account): Organization
    {
        $this->payment_account = $payment_account;
        return $this;
    }

    public function getDeletedAt(): string
    {
        return $this->deleted_at;
    }


    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Organization
    {
        $this->description = $description;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Organization
    {
        $this->email = $email;
        return $this;
    }


    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(string $phone_number): Organization
    {
        $this->phone_number = $phone_number;
        return $this;
    }

}
