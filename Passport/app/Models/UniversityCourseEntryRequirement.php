<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCourseEntryRequirement extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'course_id',
        'min_gpa',
        'min_ielts',
        'min_toefl',
        'academic_requirements_text',
        'english_requirements_text',
    ];

    public function course()
    {
        return $this->belongsTo(UniversityCourse::class, 'course_id');
    }
}
