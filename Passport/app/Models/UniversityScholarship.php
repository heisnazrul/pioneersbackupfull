<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityScholarship extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'university_id',
        'name',
        'slug',
        'amount',
        'currency',
        'deadline',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'deadline' => 'date',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function details()
    {
        return $this->hasOne(UniversityScholarshipDetail::class, 'scholarship_id');
    }
}
