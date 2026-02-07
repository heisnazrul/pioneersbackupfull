<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSchoolSupplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'ar_name',
        'amount',
        'currency',
        'billing_unit',
        'billing_count',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'billing_count' => 'integer',
    ];

    public function branch()
    {
        return $this->belongsTo(LanguageSchoolBranch::class, 'branch_id');
    }
}
