<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ar_name',
        'slug',
        'description',
        'ar_description',
        'country_id',
        'latitude',
        'longitude',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'display_order' => 'int',
        'is_active' => 'bool',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function branches()
    {
        return $this->hasMany(SchoolBranch::class, 'city_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
