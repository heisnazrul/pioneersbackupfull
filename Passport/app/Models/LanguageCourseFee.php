<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCourseFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_course_id',
        'week_number',
        'fee',
        'valid_from',
        'valid_to',
        'price_split',
    ];

    protected $casts = [
        'valid_from' => 'date',
        'valid_to' => 'date',
        'fee' => 'decimal:2',
    ];

    public function course()
    {
        return $this->belongsTo(LanguageCourse::class, 'language_course_id');
    }
}
