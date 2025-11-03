<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'float',
        'stock' => 'integer',
    ];
}
