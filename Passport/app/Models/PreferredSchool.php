<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferredSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'active',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
