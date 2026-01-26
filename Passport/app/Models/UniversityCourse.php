<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCourse extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'university_id',
        'campus_id',
        'level_id',
        'faculty_name',
        'name',
        'slug',
        'duration_months',
        'tuition_fee',
        'currency',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function campus()
    {
        return $this->belongsTo(UniversityCampus::class);
    }

    public function level()
    {
        return $this->belongsTo(UniversityCourseLevel::class, 'level_id');
    }

    public function details()
    {
        return $this->hasOne(UniversityCourseDetail::class, 'course_id');
    }

    public function requirements()
    {
        return $this->hasOne(UniversityCourseEntryRequirement::class, 'course_id');
    }

    public function intakes()
    {
        return $this->hasMany(UniversityIntake::class, 'course_id');
    }
}
