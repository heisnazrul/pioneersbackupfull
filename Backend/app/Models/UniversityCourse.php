<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UniversityCourse extends Model
{
    protected $fillable = [
        'university_id',
        'level_id',
        'subject_area_id',
        'name',
        'ar_name',
        'slug',
        'duration_value',
        'duration_unit',
        'overview',
        'ar_overview',
        'awarding_body',
        'ar_awarding_body',
        'first_year_fee',
        'currency',
        'degree_requirement',
        'language_requirement',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'duration_value' => 'integer',
        'first_year_fee' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function subjectArea()
    {
        return $this->belongsTo(SubjectArea::class);
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function wishlists()
    {
        return $this->hasMany(UniversityWishlist::class, 'course_id');
    }

    public function intakeTerms()
    {
        return $this->belongsToMany(IntakeTerm::class, 'university_course_intakes')
            ->using(UniversityCourseIntake::class)
            ->withPivot(['deadline_date', 'start_date', 'is_active'])
            ->withTimestamps();
    }
}
