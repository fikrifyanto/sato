<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
        'images',
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'color',
        'weight',
        'description',
        'status',
        'vaccinated',
        'price',
    ];

    protected $casts = [
        'vaccinated' => 'boolean',
        'images' => 'array',
    ];
}
