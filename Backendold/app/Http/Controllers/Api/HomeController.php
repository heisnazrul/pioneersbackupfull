<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Country;
use App\Models\Level;
use App\Models\SubjectArea;

class HomeController extends Controller
{
    /**
     * Helper to get full image URL.
     */
    private function getImageUrl(?string $path)
    {
        if (!$path) {
            return null;
        }

        if (str_starts_with($path, 'http')) {
            return $path;
        }

        return url(\Illuminate\Support\Facades\Storage::url($path));
    }

    public function hero()
    {
        // 1. Featured Universities
        $featureUniversities = University::with('city')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->get()
            ->map(function ($u) {
                return [
                    'name' => $u->name,
                    'city_name' => $u->city ? $u->city->name : null,
                    'logo' => $this->getImageUrl($u->logo),
                ];
            });

        // 2. All Universities
        $universities = University::with('city')
            ->where('is_active', true)
            ->get()
            ->map(function ($u) {
                return [
                    'name' => $u->name,
                    'city_name' => $u->city ? $u->city->name : null,
                    'logo' => $this->getImageUrl($u->logo),
                ];
            });

        // 3. Featured Countries
        $featureCountries = Country::where('is_active', true)
            ->where('is_popular', true)
            ->get()
            ->map(function ($c) {
                return [
                    'name' => $c->name,
                    'flag' => $this->getImageUrl($c->flag),
                ];
            });

        // 4. All Levels
        $levels = Level::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($l) {
                return [
                    'name' => $l->name,
                ];
            });

        // 5. Featured/Popular Courses (Data for search dropdown)
        $courses = \App\Models\UniversityCourse::where('is_active', true)
            ->select('name')
            ->distinct()
            ->inRandomOrder()
            ->limit(20)
            ->get()
            ->map(function ($c) {
                return [
                    'name' => $c->name,
                ];
            });

        // 6. All Intakes
        $intakes = \App\Models\IntakeTerm::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($i) {
                return [
                    'name' => $i->name,
                ];
            });

        return response()->json([
            'feature_universities' => $featureUniversities,
            'universities' => $universities,
            'feature_countries' => $featureCountries,
            'levels' => $levels,
            'courses' => $courses,
            'intakes' => $intakes,
        ]);
    }

    public function certificate()
    {
        $certificates = \App\Models\Certification::all()
            ->map(function ($c) {
                return [
                    'title' => $c->title,
                    'image' => $this->getImageUrl($c->certificate_image),
                    'link' => $c->certification_link,
                ];
            });

        return response()->json($certificates);
    }

    public function destinations()
    {
        $destinations = \App\Models\Destination::select('name', 'image_url', 'slug')
            ->where('is_active', true)
            ->get()
            ->map(function ($d) {
                return [
                    'name' => $d->name,
                    'image' => $this->getImageUrl($d->image_url),
                    'slug' => $d->slug,
                ];
            });

        return response()->json($destinations);
    }

    public function universities()
    {
        $universities = University::with(['city', 'country'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->get()
            ->map(function ($u) {
                return [
                    'id' => $u->id,
                    'name' => $u->name,
                    'slug' => $u->slug,
                    'logo' => $this->getImageUrl($u->logo),
                    'rank' => $u->rank,
                    'address' => ($u->city ? $u->city->name : '') . ($u->city && $u->country ? ', ' : '') . ($u->country ? $u->country->name : ''),
                    'famous_for' => $u->famous_for,
                ];
            });

        return response()->json($universities);
    }

    public function reviews()
    {
        $allReviews = \App\Models\Review::active()
            ->orderBy('created_at', 'desc')
            ->get();

        $videoReviews = $allReviews->filter(function ($r) {
            return !empty($r->video_url);
        })->values()->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => $r->name,
                'university_name' => $r->institute_name ?? $r->university_name, // fallback
                'course_name' => $r->course_name,
                'country_name' => $r->country_name,
                'thumbnail' => $this->getImageUrl($r->thumbnail),
                'duration' => "2:00",
                'review_text' => $r->review_text,
                'video_url' => $r->video_url,
                'video_iframe' => $r->video_iframe,
            ];
        });

        $textReviews = $allReviews->values()->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => $r->name,
                'role' => $r->course_name ?? 'Student',
                'title' => $r->title ?? 'Great Experience',
                'text' => $r->review_text,
                'rating' => $r->rating,
            ];
        });

        return response()->json([
            'video_reviews' => $videoReviews,
            'reviews' => $textReviews,
        ]);
    }

    public function scholarships()
    {
        $scholarships = \App\Models\Scholarship::active()
            ->orderBy('deadline_date', 'asc')
            ->get()
            ->map(function ($s) {
                // Format amount
                $amount = '';
                if ($s->amount_type === 'fixed') {
                    $amount = $s->currency . number_format((float) $s->amount_value);
                } elseif ($s->amount_type === 'percentage') {
                    $amount = $s->amount_value . '% Tuition';
                } else {
                    $amount = 'Variable';
                    if ($s->min_amount && $s->max_amount) {
                        $amount = $s->currency . number_format((float) $s->min_amount) . ' - ' . number_format((float) $s->max_amount);
                    } elseif ($s->max_amount) {
                        $amount = 'Up to ' . $s->currency . number_format((float) $s->max_amount);
                    }
                }

                return [
                    'id' => $s->id,
                    'title' => $s->name,
                    'slug' => $s->slug,
                    'amount' => $amount,
                    'deadline' => $s->deadline_date ? $s->deadline_date->format('d F Y') : 'Rolling',
                    'tags' => $s->tags ?? [],
                ];
            });

        return response()->json($scholarships);
    }

    public function blogs()
    {
        $blogs = \App\Models\Blog::with('category')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(10)
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'summary' => $blog->summary,
                    'category' => $blog->category ? $blog->category->name : 'Blog',
                    'image' => $this->getImageUrl($blog->featured_image),
                    'slug' => $blog->slug,
                    'published_at' => $blog->published_at->format('d M Y'),
                ];
            });

        return response()->json([
            'status' => 200,
            'data' => $blogs
        ]);
    }

    public function faqs()
    {
        $faqs = \App\Models\Faq::all()->map(function ($faq) {
            return [
                'id' => $faq->id,
                'category' => $faq->category,
                'question' => $faq->question,
                'answer' => $faq->answer,
            ];
        });

        return response()->json([
            'status' => 200,
            'data' => $faqs
        ]);
    }
}
