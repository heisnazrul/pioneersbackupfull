<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'cover_image',
        'country_id',
        'city_id',
        'type',
        'established_year',
        'website',
        'rank',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'established_year' => 'integer',
        'rank' => 'integer',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function details()
    {
        return $this->hasOne(UniversityDetail::class);
    }

    public function galleries()
    {
        return $this->hasMany(UniversityGallery::class);
    }

    public function courses()
    {
        return $this->hasMany(UniversityCourse::class);
    }

    public function scholarships()
    {
        return $this->hasMany(UniversityScholarship::class);
    }

    public function campuses()
    {
        return $this->hasMany(UniversityCampus::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
