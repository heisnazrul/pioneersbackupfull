<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchPickup extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_branch_id',
        'city_id',
        'fee',
        'note',
    ];

    protected $casts = [
        'fee' => 'decimal:2',
    ];

    public function branch()
    {
        return $this->belongsTo(SchoolBranch::class, 'school_branch_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
