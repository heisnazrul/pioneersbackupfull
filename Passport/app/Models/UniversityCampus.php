<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityCampus extends Model
{
    use HasFactory;

    protected $fillable = [
        'university_id',
        'city_id',
        'name',
        'slug',
        'address',
        'map_coordinates'
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function courses()
    {
        return $this->hasMany(UniversityCourse::class, 'campus_id');
    }
}
