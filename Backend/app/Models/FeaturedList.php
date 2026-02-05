<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedList extends Model
{
    protected $fillable = [
        'key',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
