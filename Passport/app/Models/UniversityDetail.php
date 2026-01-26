<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityDetail extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'university_id',
        'description',
        'history',
        'facilities',
        'accommodation_info',
        'address',
        'map_coordinates',
        'rank_national',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
