<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    private function getImageUrl(?string $path)
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return asset('storage/' . $path);
    }

    public function show($slug)
    {
        $scholarship = Scholarship::where('slug', $slug)
            ->where('is_active', true)
            ->with(['university'])
            ->firstOrFail();

        // Format Amount (Reused logic from HomeController)
        $amountDisplay = '';
        if ($scholarship->amount_type === 'fixed') {
            $amountDisplay = $scholarship->currency . number_format((float) $scholarship->amount_value);
        } elseif ($scholarship->amount_type === 'percentage') {
            $amountDisplay = $scholarship->amount_value . '% Tuition';
        } else {
            $amountDisplay = 'Variable';
            if ($scholarship->min_amount && $scholarship->max_amount) {
                $amountDisplay = $scholarship->currency . number_format((float) $scholarship->min_amount) . ' - ' . number_format((float) $scholarship->max_amount);
            } elseif ($scholarship->max_amount) {
                $amountDisplay = 'Up to ' . $scholarship->currency . number_format((float) $scholarship->max_amount);
            }
        }

        $data = [
            'id' => $scholarship->id,
            'name' => $scholarship->name,
            'slug' => $scholarship->slug,
            'provider_name' => $scholarship->provider_name,
            'summary' => $scholarship->summary,
            'description' => $scholarship->description,
            'amount_display' => $amountDisplay,
            'deadline' => $scholarship->deadline_date ? $scholarship->deadline_date->format('d F Y') : 'Rolling',
            'eligible_nationalities' => $scholarship->eligible_nationalities,
            'eligibility_text' => $scholarship->eligibility_text,
            'apply_link' => $scholarship->apply_link,
            'tags' => $scholarship->tags,
            'university' => $scholarship->university ? [
                'name' => $scholarship->university->name,
                'slug' => $scholarship->university->slug,
                'logo' => $this->getImageUrl($scholarship->university->logo),
            ] : null,
        ];

        return response()->json($data);
    }
}
