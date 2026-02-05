<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'country_id',
        'slug',
        'name',
        'region',
        'description',
        'image_url',
        'short_pitch',
        'tuition_range',
        'visa_timeline',
        'work_rights',
        'scholarships_summary',
        'entry_req_gpa',
        'entry_req_language',
        'university_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'university_count' => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (Destination $destination) {
            $destination->slug = static::generateSlug($destination->slug, $destination->name);
        });

        static::updating(function (Destination $destination) {
            $destination->slug = static::generateSlug($destination->slug, $destination->name, $destination->id);
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function guide()
    {
        return $this->hasOne(DestinationGuide::class)->where('is_active', true)->latest();
    }

    public static function generateSlug(?string $slug, string $title, ?int $ignoreId = null): string
    {
        $base = trim($slug ?: Str::slug($title));
        $base = $base !== '' ? Str::limit($base, 255, '') : Str::random(8);

        $candidate = $base;
        $suffix = 1;
        while (
            static::withTrashed()
                ->when($ignoreId, fn($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $candidate)
                ->exists()
        ) {
            $candidate = Str::limit("{$base}-{$suffix}", 255, '');
            if ($candidate === '') {
                $candidate = Str::random(8);
            }
            $suffix++;
        }

        return $candidate;
    }
}
