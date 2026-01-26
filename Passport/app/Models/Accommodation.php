<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_branch_id',
        'language_course_tag_id',
        'required_age',
        'fee_per_week',
        'admin_charge',
        'under18_supplement_per_week',
        'bedroom_type_id',
        'bathroom_type_id',
        'meal_plan_id',
        'notes',
    ];

    protected $casts = [
        'required_age' => 'int',
        'fee_per_week' => 'decimal:2',
        'admin_charge' => 'decimal:2',
        'under18_supplement_per_week' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'school_branch_id');
    }

    public function tag()
    {
        return $this->belongsTo(LanguageCourseTag::class, 'language_course_tag_id');
    }

    public function bedroomType()
    {
        return $this->belongsTo(BedroomType::class);
    }

    public function bathroomType()
    {
        return $this->belongsTo(BathroomType::class);
    }

    public function mealPlan()
    {
        return $this->belongsTo(MealPlan::class);
    }
}
