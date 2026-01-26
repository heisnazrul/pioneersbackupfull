<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageCourseMaterialFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_course_id',
        'amount',
        'billing_unit',
        'billing_count',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'billing_count' => 'int',
    ];

    public function course()
    {
        return $this->belongsTo(LanguageCourse::class, 'language_course_id');
    }
}
