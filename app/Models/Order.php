<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'address_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'address_type',
        'address_label',
        'address_province',
        'address_city',
        'address_district',
        'address_postcode',
        'address_detail',
        'address_notes',
        'amount',
        'status',
    ];

    protected $casts = [
        'amount' => 'float',
        'status' => OrderStatus::class,
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderPayments(): HasMany
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function lastOrderPayment(): HasOne
    {
        return $this->hasOne(OrderPayment::class)->latestOfMany();
    }
}
