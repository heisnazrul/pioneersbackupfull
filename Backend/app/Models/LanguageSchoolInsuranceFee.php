<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageSchoolInsuranceFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
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
