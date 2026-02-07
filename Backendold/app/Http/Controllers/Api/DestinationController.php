<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    private function getImageUrl(?string $path)
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return url(Storage::url($path));
    }

    public function index()
    {
        $destinations = Destination::with(['country', 'features', 'stats', 'intakes', 'requirements', 'faqs'])
            ->where('is_active', true)
            ->get();

        $data = $destinations->map(function ($dest) {
            // Get top universities for this destination's country
            $topUniversities = [];
            if ($dest->country_id) {
                $topUniversities = University::where('country_id', $dest->country_id)
                    ->where('is_active', true)
                    ->orderBy('rank', 'asc') // Assuming lower rank is better
                    ->take(3)
                    ->get()
                    ->map(function ($uni) {
                        return [
                            'id' => (string) $uni->id,
                            'name' => $uni->name,
                            'rank' => $uni->rank ? "#{$uni->rank} " . ($uni->country ? $uni->country->country_code : '') : '',
                            'location' => $uni->city ? $uni->city->name : '',
                            'countryCode' => $uni->country ? $uni->country->country_code : '',
                            'cityId' => (string) $uni->city_id,
                            'worldRank' => $uni->rank,
                            'logoUrl' => $this->getImageUrl($uni->logo),
                            'slug' => $uni->slug,
                        ];
                    });
            }

            return [
                'id' => (string) $dest->id,
                'slug' => $dest->slug,
                'name' => $dest->name,
                'countryCode' => $dest->country ? $dest->country->country_code : '', // Assuming 'gb', 'us' etc.
                'description' => $dest->description,
                'imageUrl' => $this->getImageUrl($dest->image_url),
                'features' => $dest->features->pluck('feature'),
                'shortPitch' => $dest->short_pitch,
                'tuitionRange' => $dest->tuition_range,
                'visaTimeline' => $dest->visa_timeline,
                'workRights' => $dest->work_rights,
                'scholarships' => $dest->scholarships_summary,
                // For popularPrograms, we might need a relation or logic. For now returning empty or could be fetched if relation existed
                'popularPrograms' => [],
                'topUniversities' => $topUniversities,
                'intakeTimeline' => $dest->intakes->map(function ($intake) {
                    return [
                        'month' => $intake->month,
                        'event' => $intake->event,
                    ];
                }),
                'requirements' => $dest->requirements->pluck('requirement'), // Assuming 'requirement' column based on typical pattern, if strictly needed check model
                'faqs' => $dest->faqs->map(function ($faq) {
                    return [
                        'id' => (string) $faq->id,
                        'question' => $faq->question,
                        'answer' => $faq->answer,
                    ];
                }),
                'region' => $dest->region,
                'stats' => $dest->stats->map(function ($stat) {
                    return [
                        'label' => $stat->label,
                        'value' => $stat->value,
                    ];
                }),
            ];
        });

        return response()->json($data);
    }

    public function show($slug)
    {
        $dest = Destination::with(['country', 'features', 'stats', 'intakes', 'requirements', 'faqs'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Get top universities for this destination's country
        $topUniversities = [];
        if ($dest->country_id) {
            $topUniversities = University::where('country_id', $dest->country_id)
                ->where('is_active', true)
                ->orderBy('rank', 'asc')
                ->take(3)
                ->get()
                ->map(function ($uni) {
                    return [
                        'id' => (string) $uni->id,
                        'name' => $uni->name,
                        'rank' => $uni->rank ? "#{$uni->rank} " . ($uni->country ? $uni->country->country_code : '') : null, // Return null if no rank
                        'location' => $uni->city ? $uni->city->name : '',
                        'countryCode' => $uni->country ? $uni->country->country_code : '',
                        'slug' => $uni->slug,
                        'logoUrl' => $this->getImageUrl($uni->logo),
                    ];
                });
        }

        // Get popular programs (courses) for this destination's country
        // Logic: Get courses from universities in this country, take unique names to show variety
        $popularPrograms = [];
        if ($dest->country_id) {
            $popularPrograms = \App\Models\UniversityCourse::whereHas('university', function ($q) use ($dest) {
                $q->where('country_id', $dest->country_id);
            })
                ->where('is_active', true)
                ->with('level')
                ->select('id', 'name', 'level_id', 'duration_value', 'duration_unit')
                ->latest() // Get recent ones or could order by popularity if tracked
                ->take(50) // Fetch a pool to filter unique from
                ->get()
                ->unique('name')
                ->take(6)
                ->map(function ($course) {
                    return [
                        'id' => (string) $course->id,
                        'name' => $course->name,
                        'level' => $course->level ? $course->level->name : '',
                        'duration' => $course->duration_value . ' ' . $course->duration_unit,
                    ];
                })
                ->values();
        }

        return response()->json([
            'id' => (string) $dest->id,
            'slug' => $dest->slug,
            'name' => $dest->name,
            'countryCode' => $dest->country ? $dest->country->country_code : '',
            'description' => $dest->description,
            'imageUrl' => $this->getImageUrl($dest->image_url),
            'features' => $dest->features->pluck('feature'),
            'shortPitch' => $dest->short_pitch,
            'tuitionRange' => $dest->tuition_range,
            'visaTimeline' => $dest->visa_timeline,
            'workRights' => $dest->work_rights,
            'scholarships' => $dest->scholarships_summary,
            'popularPrograms' => $popularPrograms,
            'topUniversities' => $topUniversities,
            'intakeTimeline' => $dest->intakes->map(function ($intake) {
                return [
                    'month' => $intake->month,
                    'event' => $intake->event,
                ];
            }),
            'requirements' => $dest->requirements->pluck('requirement'),
            'faqs' => $dest->faqs->map(function ($faq) {
                return [
                    'id' => (string) $faq->id,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                ];
            }),
            'region' => $dest->region,
            'stats' => $dest->stats->map(function ($stat) {
                return [
                    'label' => $stat->label,
                    'value' => $stat->value,
                ];
            }),
            'guide' => $dest->guide ? [
                'title' => $dest->guide->title,
                'fileUrl' => $this->getImageUrl($dest->guide->file_path),
                'year' => $dest->guide->year,
            ] : null,
        ]);
    }
}
