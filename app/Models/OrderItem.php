<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'item_id',
        'item_type',
        'is_adoption',
        'name',
        'description',
        'metadata',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'float',
        'subtotal' => 'float',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
