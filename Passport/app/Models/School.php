<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ar_name',
        'slug',
        'description',
        'ar_description',
        'logo',
        'accreditation_ids',
        'rating',
    ];

    protected $casts = [
        'accreditation_ids' => 'array',
        'rating' => 'float',
    ];

    public function branches()
    {
        return $this->hasMany(SchoolBranch::class, 'school_id');
    }
}
