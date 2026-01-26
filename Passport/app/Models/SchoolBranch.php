<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LanguageCourse;
use App\Models\BranchRegistrationFee;
use App\Models\BranchPickup;
use App\Models\BranchInsurance;
use App\Models\Accommodation;

class SchoolBranch extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'city_id',
        'slug',
        'description',
        'ar_description',
        'gallery_urls',
        'video_url',
    ];

    protected $casts = [
        'gallery_urls' => 'array',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function languageCourses()
    {
        return $this->hasMany(LanguageCourse::class, 'branch_id');
    }

    public function registrationFees()
    {
        return $this->hasMany(BranchRegistrationFee::class, 'branch_id');
    }

    public function pickups()
    {
        return $this->hasMany(BranchPickup::class, 'school_branch_id');
    }

    public function insurances()
    {
        return $this->hasMany(BranchInsurance::class, 'school_branch_id');
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'school_branch_id');
    }
}
