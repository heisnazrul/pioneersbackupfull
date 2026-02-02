<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'slug',
        'city',
        'country',
        'address',
        'phone',
        'email',
        'type',
        'image',
        'map_url',
        'description',
        'hours'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
