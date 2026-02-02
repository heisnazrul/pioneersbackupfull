<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'university' => $this->university->name,
            'universityId' => $this->university_id,
            'universityLogo' => $this->getUniversityLogo(),
            'location' => $this->getLocation(),
            'countryCode' => $this->university->country->country_code ?? null,
            'level' => $this->level->name ?? null,
            'discipline' => $this->subjectArea->name ?? null,
            'duration' => $this->getDuration(),
            'tuition' => $this->first_year_fee,
            'currency' => $this->currency,
            'description' => $this->overview,
            'languageRequirement' => $this->language_requirement,
            'degreeRequirement' => $this->degree_requirement,
            'intake' => $this->intakeTerms->pluck('name')->toArray(),
            'applicationDeadline' => $this->intakeTerms->first()?->pivot->deadline_date,
        ];
    }

    /**
     * Get formatted location string
     */
    private function getLocation(): string
    {
        $city = $this->university->city->name ?? '';
        $country = $this->university->country->name ?? '';

        if ($city && $country) {
            return "{$city}, {$country}";
        }

        return $country ?: $city;
    }

    /**
     * Get formatted duration string
     */
    private function getDuration(): string
    {
        if (!$this->duration_value) {
            return '';
        }

        $value = $this->duration_value;
        $unit = $this->duration_unit;

        // Convert to years if months >= 12
        if ($unit === 'month' && $value >= 12) {
            $years = floor($value / 12);
            $months = $value % 12;

            if ($months > 0) {
                return "{$years} Year" . ($years > 1 ? 's' : '') . " {$months} Month" . ($months > 1 ? 's' : '');
            }

            return "{$years} Year" . ($years > 1 ? 's' : '');
        }

        return "{$value} " . ucfirst($unit) . ($value > 1 ? 's' : '');
    }

    /**
     * Get university logo URL
     */
    private function getUniversityLogo(): ?string
    {
        $logo = $this->university->logo;

        if (!$logo) {
            return null;
        }

        // If it's already a full URL, return as is
        if (str_starts_with($logo, 'http')) {
            return $logo;
        }

        // Otherwise, prepend storage path
        return asset('storage/' . $logo);
    }
}
