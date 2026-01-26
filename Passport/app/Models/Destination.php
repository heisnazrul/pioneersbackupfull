<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded = ['id'];

    public function features()
    {
        return $this->hasMany(DestinationFeature::class);
    }

    public function stats()
    {
        return $this->hasMany(DestinationStat::class);
    }

    public function intakes()
    {
        return $this->hasMany(DestinationIntake::class);
    }

    public function faqs()
    {
        return $this->hasMany(DestinationFaq::class);
    }

    public function requirements()
    {
        return $this->hasMany(DestinationRequirement::class);
    }

    public function disciplines()
    {
        return $this->hasMany(DestinationDiscipline::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
