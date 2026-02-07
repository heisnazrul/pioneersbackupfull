<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UniversityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isDetailView = $request->route()->getName() === 'api.universities.show';

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'countryCode' => $this->country->country_code ?? null,
            'location' => $this->getLocation(),
            'rank' => $this->rank ? "#{$this->rank}" : null,
            'logoUrl' => $this->getImageUrl($this->logo),
            'isFeatured' => $this->is_featured,
            'famousFor' => $this->famous_for,
        ];

        // Add detailed information when viewing single university
        if ($isDetailView) {
            $data = array_merge($data, [
                'coverImageUrl' => $this->getImageUrl($this->cover_image),
                'description' => $this->description,
                'establishedYear' => $this->established_year,
                'type' => ucfirst($this->type),
                'studentCount' => $this->student_count,
                'employmentRate' => $this->employment_rate,
                'website' => $this->website,
                'fees' => $this->fees,
                'intakes' => $this->getIntakes(),
                'courses' => $this->getCoursesPreview(),
            ]);
        }

        return $data;
    }

    /**
     * Get formatted location string
     */
    private function getLocation(): string
    {
        $city = $this->city->name ?? '';
        $country = $this->country->name ?? '';

        if ($city && $country) {
            return "{$city}, {$country}";
        }

        return $country ?: $city;
    }

    /**
     * Get full image URL
     */
    private function getImageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return asset('storage/' . $path);
    }

    /**
     * Get aggregated intakes from courses
     */
    private function getIntakes(): array
    {
        if (!$this->relationLoaded('courses')) {
            return [];
        }

        $intakes = collect();

        foreach ($this->courses as $course) {
            if ($course->relationLoaded('intakeTerms')) {
                foreach ($course->intakeTerms as $intake) {
                    $intakes->push([
                        'id' => $intake->id,
                        'name' => $intake->name,
                        'month' => $intake->month_num ? date('F', mktime(0, 0, 0, $intake->month_num, 1)) : null,
                        'deadline' => $intake->pivot->deadline_date ?? null,
                    ]);
                }
            }
        }

        return $intakes->unique('id')->values()->toArray();
    }

    /**
     * Get preview of courses (limited to 6)
     */
    private function getCoursesPreview(): array
    {
        if (!$this->relationLoaded('courses')) {
            return [];
        }

        return $this->courses->take(6)->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'slug' => $course->slug,
                'level' => $course->level->name ?? null,
                'duration' => $this->formatDuration($course->duration_value, $course->duration_unit),
            ];
        })->toArray();
    }

    /**
     * Format duration string
     */
    private function formatDuration(?int $value, ?string $unit): string
    {
        if (!$value) {
            return '';
        }

        if ($unit === 'month' && $value >= 12) {
            $years = floor($value / 12);
            return "{$years} Year" . ($years > 1 ? 's' : '');
        }

        return "{$value} " . ucfirst($unit) . ($value > 1 ? 's' : '');
    }
}
