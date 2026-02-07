<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LanguageSchoolAccommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'title',
        'ar_title',
        'slug',
        'description',
        'ar_description',
        'price',
        'currency',
        'features',
        'image',
        'details',
        'ar_details',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'features' => 'array',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug) && $model->title) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function branch()
    {
        return $this->belongsTo(LanguageSchoolBranch::class, 'branch_id');
    }
}
