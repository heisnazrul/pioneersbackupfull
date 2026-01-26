<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityCms extends Model
{
    use HasFactory;

    protected $table = 'university_cms';

    protected $fillable = [
        'section',
        'content',
    ];

    protected $casts = [
        'content' => 'array',
    ];
}
