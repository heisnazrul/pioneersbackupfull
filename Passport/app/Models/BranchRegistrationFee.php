<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchRegistrationFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'amount',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'branch_id');
    }
}
