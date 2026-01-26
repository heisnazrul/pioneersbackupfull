<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCourseDetail extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'course_id',
        'overview',
        'curriculum',
        'career_opportunities',
    ];

    public function course()
    {
        return $this->belongsTo(UniversityCourse::class, 'course_id');
    }
}
