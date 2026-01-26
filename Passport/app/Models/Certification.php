<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ar_title',
        'subtitle',
        'ar_subtitle',
        'certificate_image',
        'certification_link',
    ];
}