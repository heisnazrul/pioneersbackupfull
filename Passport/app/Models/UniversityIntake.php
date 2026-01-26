<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityIntake extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'course_id',
        'month',
        'start_date',
        'deadline',
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(UniversityCourse::class, 'course_id');
    }
}
