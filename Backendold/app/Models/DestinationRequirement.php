<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'requirement'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
