<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummerCampDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'camp_id',
        'overview',
        'ar_overview',
        'academics',
        'ar_academics',
        'activities',
        'ar_activities',
        'accommodation',
        'ar_accommodation',
        'safeguarding',
        'ar_safeguarding',
    ];

    public function camp()
    {
        return $this->belongsTo(SummerCamp::class, 'camp_id');
    }
}
