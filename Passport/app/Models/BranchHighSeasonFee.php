<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchHighSeasonFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'season_start_date',
        'season_end_date',
        'amount_per_week',
    ];

    protected $casts = [
        'season_start_date' => 'date',
        'season_end_date' => 'date',
        'amount_per_week' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'branch_id');
    }
}
