<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ar_name',
        'slug',
        'flag',
        'country_code',
        'currency_code',
        'phone_code',
        'description',
        'ar_description',
        'capital',
        'continent',
        'display_order',
        'is_popular',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'bool',
        'display_order' => 'int',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id');
    }
}
