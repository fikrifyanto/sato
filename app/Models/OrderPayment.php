<?php

namespace App\Models;

use App\Enums\OrderPaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPayment extends Model
{
    protected $fillable = [
        'token',
        'payment_id',
        'payment_url',
        'payment_method',
        'amount',
        'metadata',
        'status',
    ];

    protected array $dates = ['paid_at', 'expired_at'];

    protected $casts = [
        'metadata' => 'json',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'amount' => 'float',
        'status' => OrderPaymentStatus::class,
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
