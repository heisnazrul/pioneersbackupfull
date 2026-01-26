<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_branch_id',
        'fee',
        'admin_charge',
        'billing_unit',
        'billing_count',
        'valid_from',
        'valid_to',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
        'admin_charge' => 'decimal:2',
        'billing_count' => 'int',
        'valid_from' => 'date',
        'valid_to' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'school_branch_id');
    }
}
