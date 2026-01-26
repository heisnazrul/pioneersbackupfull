<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchSupplement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ar_name',
        'school_branch_id',
        'start_date',
        'end_date',
        'fee',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'fee' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'school_branch_id');
    }
}
