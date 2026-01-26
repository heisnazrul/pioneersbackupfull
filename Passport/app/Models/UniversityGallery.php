<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityGallery extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'university_id',
        'image_url',
        'caption',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
