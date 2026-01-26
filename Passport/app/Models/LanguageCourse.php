<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'language_course_type_id',
        'language_course_tag_id',
        'slug',
        'name',
        'ar_name',
        'description',
        'ar_description',
        'start_day',
        'required_level',
        'study_time',
        'lessons_per_week',
        'min_age',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'branch_id');
    }

    public function type()
    {
        return $this->belongsTo(LanguageCourseType::class, 'language_course_type_id');
    }

    public function tag()
    {
        return $this->belongsTo(LanguageCourseTag::class, 'language_course_tag_id');
    }

    public function fees()
    {
        return $this->hasMany(LanguageCourseFee::class, 'language_course_id');
    }

    public function materialFees()
    {
        return $this->hasMany(LanguageCourseMaterialFee::class, 'language_course_id');
    }
}
