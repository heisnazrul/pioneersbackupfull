<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityScholarshipDetail extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'scholarship_id',
        'description',
        'eligibility_criteria',
        'application_process',
    ];

    public function scholarship()
    {
        return $this->belongsTo(UniversityScholarship::class, 'scholarship_id');
    }
}
