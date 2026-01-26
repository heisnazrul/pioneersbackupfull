<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCourse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'school_id',
        'branch_id',
        'course_type_id',
        'tag_id',
        'name',
        'ar_name',
        'description',
        'ar_description',
        'required_level',
        'study_time',
        'lessons_per_week',
        'min_age',
        'start_date',
        'fee_type',
        'fee_amount',
        'currency_code',
        'registration_fee',
        'thumbnail',
        'visible',
        'status',
    ];

    protected $casts = [
        'fee_amount' => 'decimal:2',
        'registration_fee' => 'decimal:2',
        'visible' => 'bool',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'branch_id');
    }

    public function courseType()
    {
        return $this->belongsTo(LanguageCourseType::class, 'course_type_id');
    }

    public function tag()
    {
        return $this->belongsTo(LanguageCourseTag::class);
    }
}
