<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationFeature extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'feature'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
