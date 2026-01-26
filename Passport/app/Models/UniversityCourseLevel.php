<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityCourseLevel extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function courses()
    {
        return $this->hasMany(UniversityCourse::class, 'level_id');
    }
}
