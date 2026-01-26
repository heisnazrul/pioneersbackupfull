<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use App\Models\LanguageCourseType;
use App\Models\School;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Certification;
use App\Models\LanguageCourse;
use App\Models\LanguageCourseTag;
use App\Models\LanguageCourseFee;
use App\Models\Discount;
use App\Models\ExchangeRate;
use App\Models\ConversionFee;
use App\Models\OnlineCourse;
use App\Models\SummerCamp;
use App\Models\Review;
use App\Models\Blog;
use App\Models\PreferredSchool;
use App\Models\VideoReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Home extends Controller
{
    /** Cache TTL: 30 days */
    protected $cacheTtl;

    public function __construct()
    {
        $this->cacheTtl = now()->addDays(30);
    }

    public function faqs(Request $request)
    {
        $key = "api:faqs";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Faq::query()
                ->orderBy('category')
                ->orderBy('id')
                ->get(['id', 'category', 'ar_category', 'question', 'ar_question', 'answer', 'ar_answer']);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function countries()
    {
        $key = "api:home:countries";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Country::query()
                ->active()
                ->orderBy('display_order')
                ->orderBy('name')
                ->get(['id', 'name', 'ar_name', 'flag'])
                ->map(fn($country) => [
                    'id' => $country->id,
                    'name' => $country->name,
                    'ar_name' => $country->ar_name,
                    'flag' => $country->flag,
                ]);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function cities(Request $request)
    {
        $countryId = $request->get('country_id');
        $key = "api:home:cities:country:" . ($countryId ?? 'all');

        $data = Cache::remember($key, $this->cacheTtl, function () use ($countryId) {
            $query = City::query()->active()->orderBy('display_order')->orderBy('name');
            if ($countryId) {
                $query->where('country_id', $countryId);
            }
            return $query->get(['id', 'name', 'ar_name', 'country_id'])
                ->map(fn($city) => [
                    'id' => $city->id,
                    'name' => $city->name,
                    'ar_name' => $city->ar_name,
                    'country_id' => $city->country_id,
                ]);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function languageCourseTypes()
    {
        $key = "api:home:language-course-types";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return LanguageCourseType::query()
                ->orderBy('name')
                ->get(['id', 'type_code', 'name', 'ar_name'])
                ->map(fn($type) => [
                    'id' => $type->id,
                    'type_code' => $type->type_code,
                    'name' => $type->name,
                    'ar_name' => $type->ar_name,
                ]);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function schools()
    {
        $key = "api:home:schools";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return School::query()
                ->orderBy('name')
                ->get(['id', 'name', 'ar_name', 'slug', 'logo'])
                ->map(fn($school) => [
                    'id' => $school->id,
                    'name' => $school->name,
                    'ar_name' => $school->ar_name,
                    'slug' => $school->slug,
                    'logo' => $school->logo,
                ]);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function certificates()
    {
        $key = "api:home:certificates";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Certification::query()
                ->orderBy('title')
                ->get(['id', 'title', 'ar_title', 'subtitle', 'ar_subtitle', 'certificate_image', 'certification_link'])
                ->map(fn($cert) => [
                    'id' => $cert->id,
                    'title' => $cert->title,
                    'ar_title' => $cert->ar_title,
                    'certificate_image' => $cert->certificate_image ? url('storage/' . $cert->certificate_image) : null,
                    'certification_link' => $cert->certification_link,
                ]);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function reviews()
    {
        $key = "api:home:reviews";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Review::query()
                ->where('is_approved', true)
                ->orderByDesc('rating')
                ->orderByDesc('id')
                ->limit(8)
                ->get(['id', 'name', 'ar_name', 'title', 'ar_title', 'review_text', 'ar_review_text', 'rating', 'institute_name', 'ar_institute_name'])
                ->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'name' => $review->name,
                        'ar_name' => $review->ar_name,
                        'review_text' => $review->review_text,
                        'title' => $review->title,
                        'ar_title' => $review->ar_title,
                        'ar_review_text' => $review->ar_review_text,
                        'rating' => $review->rating,
                        'institute' => $review->institute_name,
                        'institute_ar' => $review->ar_institute_name,
                    ];
                });
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function videoReviews()
    {
        $key = "api:home:video-reviews";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return VideoReview::query()
                ->where('is_active', true)
                ->orderByDesc('created_at')
                ->limit(6)
                ->get()
                ->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'name' => $review->name,
                        'course_name' => $review->course_name,
                        'university_name' => $review->university_name,
                        'country_name' => $review->country_name,
                        'review_text' => $review->review_text,
                        'video_url' => $review->video_url,
                        'thumbnail' => $review->thumbnail ? url('storage/' . $review->thumbnail) : null,
                    ];
                });
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function languageCourses()
    {
        $key = "api:home:language-courses";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $generalTypeId = LanguageCourseType::query()
                ->where('type_code', 'GENERAL_ENGLISH')
                ->value('id');

            if (!$generalTypeId) {
                return [];
            }

            $tags = LanguageCourseTag::query()
                ->whereHas('courses', function ($q) use ($generalTypeId) {
                    $q->where('language_course_type_id', $generalTypeId);
                })
                ->orderBy('name')
                ->limit(5)
                ->get(['id', 'name', 'ar_name']);

            $taggedCourses = [];
            $now = now();
            $validDiscounts = Discount::query()
                ->active()
                ->where(function ($q) use ($now) {
                    $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                })
                ->where(function ($q) use ($now) {
                    $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                })
                ->get();

            $preferredSchoolIds = PreferredSchool::query()
                ->where('active', true)
                ->pluck('school_id')
                ->all();

            foreach ($tags as $tag) {
                $baseQuery = LanguageCourse::query()
                    ->with(['branch.school', 'branch.city.country', 'type'])
                    ->where('language_course_tag_id', $tag->id)
                    ->where('language_course_type_id', $generalTypeId)
                    ->orderBy('name');

                $preferredCourses = collect();
                if (!empty($preferredSchoolIds)) {
                    $preferredCourses = (clone $baseQuery)
                        ->whereHas('branch', fn($q) => $q->whereIn('school_id', $preferredSchoolIds))
                        ->limit(6)
                        ->get(['id', 'branch_id', 'language_course_type_id', 'language_course_tag_id', 'name', 'ar_name', 'slug']);
                }

                $pickedIds = $preferredCourses->pluck('id')->all();
                if ($preferredCourses->count() < 6) {
                    $remaining = 6 - $preferredCourses->count();
                    $fallback = (clone $baseQuery)
                        ->when(!empty($pickedIds), fn($q) => $q->whereNotIn('id', $pickedIds))
                        ->limit($remaining)
                        ->get(['id', 'branch_id', 'language_course_type_id', 'language_course_tag_id', 'name', 'ar_name', 'slug']);
                    $courses = $preferredCourses->concat($fallback);
                } else {
                    $courses = $preferredCourses;
                }

                // If no preferred courses were found at all, fallback to default behavior
                if ($courses->isEmpty()) {
                    $courses = $baseQuery
                        ->limit(6)
                        ->get(['id', 'branch_id', 'language_course_type_id', 'language_course_tag_id', 'name', 'ar_name', 'slug']);
                }

                $courses = $courses->map(function ($course) use ($validDiscounts) {
                    $basePrice = LanguageCourseFee::where('language_course_id', $course->id)->min('fee');

                    $discountPct = null;
                    if ($course->branch) {
                        $countryId = $course->branch->city->country->id ?? null;
                        $branchId = $course->branch->id;
                        $discount = $validDiscounts->first(function ($d) use ($branchId, $countryId) {
                            $branchOk = $d->applies_to_all_branches || (is_array($d->school_branch_ids) && in_array($branchId, $d->school_branch_ids));
                            $countryOk = $d->applies_to_all_countries || (is_array($d->country_ids) && in_array($countryId, $d->country_ids));
                            return $branchOk && $countryOk;
                        });

                        if ($discount) {
                            $discountPct = (float) $discount->discount_percentage;
                        }
                    }

                    $discountedPrice = $basePrice;
                    if ($basePrice !== null && $discountPct !== null) {
                        $discountedPrice = round($basePrice * (1 - ($discountPct / 100)), 2);
                    }

                    $baseCurrency = $course->branch->city->country->currency_code ?? null;
                    $sarPrice = null;
                    $sarDiscounted = null;
                    if ($baseCurrency && $basePrice !== null) {
                        $rate = ExchangeRate::where('base_currency', $baseCurrency)
                            ->where('target_currency', 'SAR')
                            ->value('rate');
                        $feePct = ConversionFee::where('base_currency', $baseCurrency)
                            ->where('target_currency', 'SAR')
                            ->value('fee');
                        $multiplier = $rate ? (float) $rate : null;
                        if ($multiplier) {
                            if ($feePct !== null) {
                                $multiplier *= (1 + ((float) $feePct / 100));
                            }
                            $sarPrice = round($basePrice * $multiplier, 2);
                            if ($discountedPrice !== null) {
                                $sarDiscounted = round($discountedPrice * $multiplier, 2);
                            }
                        }
                    }

                    $branchImage = null;
                    if (is_array($course->branch->gallery_urls) && !empty($course->branch->gallery_urls)) {
                        $branchImage = $course->branch->gallery_urls[0] ?? null;
                    }

                    return [
                        'id' => $course->id,
                        'school' => $course->branch->school->name ?? null,
                        'school_ar' => $course->branch->school->ar_name ?? null,
                        'branch' => $course->branch->city->name ?? null,
                        'branch_ar' => $course->branch->city->ar_name ?? null,
                        'branch_flag' => $course->branch->city->country->flag ?? null,
                        'branch_image' => $branchImage,
                        'name' => $course->name,
                        'ar_name' => $course->ar_name,
                        'rateing' => $course->branch->school->rating ?? null,
                        'price' => [
                            'base_price' => $basePrice ? (float) $basePrice : null,
                            'currency' => $baseCurrency,
                            'converted_price' => $sarPrice,
                            'converted_currency' => $sarPrice ? 'SAR' : null,
                        ],
                        'discounted_price' => [
                            'base_price' => $discountedPrice,
                            'currency' => $baseCurrency,
                            'converted_price' => $sarDiscounted,
                            'converted_currency' => $sarDiscounted ? 'SAR' : null,
                            'discount_percentage' => $discountPct,
                        ],
                    ];
                });

                $taggedCourses[] = [
                    'tag_id' => $tag->id,
                    'tag_name' => $tag->name,
                    'tag_ar_name' => $tag->ar_name,
                    'courses' => $courses,
                ];
            }

            return $taggedCourses;
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function onlineCourses()
    {
        $key = "api:home:online-courses";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $now = now();
            $globalDiscount = Discount::query()
                ->active()
                ->where(function ($q) use ($now) {
                    $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                })
                ->where(function ($q) use ($now) {
                    $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                })
                ->where('applies_to_all_branches', true)
                ->where('applies_to_all_countries', true)
                ->orderByDesc('discount_percentage')
                ->first();

            $courses = OnlineCourse::query()
                ->with(['school.branches.city.country', 'tag'])
                ->where('visible', true)
                ->orderBy('name')
                ->limit(6)
                ->get(['id', 'school_id', 'name', 'ar_name', 'fee_amount', 'currency_code', 'thumbnail', 'tag_id']);

            return $courses->map(function ($course) use ($globalDiscount) {
                $basePrice = $course->fee_amount !== null ? (float) $course->fee_amount : null;
                $discountPct = $globalDiscount ? (float) $globalDiscount->discount_percentage : null;
                $discountedPrice = $basePrice;
                if ($basePrice !== null && $discountPct !== null) {
                    $discountedPrice = round($basePrice * (1 - ($discountPct / 100)), 2);
                }

                $baseCurrency = $course->currency_code ?: 'USD';
                $sarPrice = null;
                $sarDiscounted = null;
                if ($basePrice !== null) {
                    $rate = ExchangeRate::where('base_currency', $baseCurrency)
                        ->where('target_currency', 'SAR')
                        ->value('rate');
                    $feePct = ConversionFee::where('base_currency', $baseCurrency)
                        ->where('target_currency', 'SAR')
                        ->value('fee');
                    $multiplier = $rate ? (float) $rate : null;
                    if ($multiplier) {
                        if ($feePct !== null) {
                            $multiplier *= (1 + ((float) $feePct / 100));
                        }
                        $sarPrice = round($basePrice * $multiplier, 2);
                        if ($discountedPrice !== null) {
                            $sarDiscounted = round($discountedPrice * $multiplier, 2);
                        }
                    }
                }

                $school = $course->school;
                $firstBranch = $school?->branches?->first();
                $city = $firstBranch?->city;
                $country = $city?->country;

                return [
                    'id' => $course->id,
                    'school' => $school->name ?? null,
                    'school_ar' => $school->ar_name ?? null,
                    'location' => $city ? trim(($city->name ?? '') . ', ' . ($country->name ?? '')) : null,
                    'location_ar' => $city ? trim(($city->ar_name ?? '') . ', ' . ($country->ar_name ?? '')) : null,
                    'flag' => $country->flag ?? null,
                    'name' => $course->name,
                    'ar_name' => $course->ar_name,
                    'thumbnail' => $course->thumbnail,
                    'tag' => $course->tag->name ?? null,
                    'tag_ar' => $course->tag->ar_name ?? null,
                    'price' => [
                        'base_price' => $basePrice,
                        'currency' => $baseCurrency,
                        'converted_price' => $sarPrice,
                        'converted_currency' => $sarPrice ? 'SAR' : null,
                    ],
                    'discounted_price' => [
                        'base_price' => $discountedPrice,
                        'currency' => $baseCurrency,
                        'converted_price' => $sarDiscounted,
                        'converted_currency' => $sarDiscounted ? 'SAR' : null,
                        'discount_percentage' => $discountPct,
                    ],
                ];
            });
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function summerCamps()
    {
        $key = "api:home:summer-camps";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            $now = now();
            $globalDiscount = Discount::query()
                ->active()
                ->where(function ($q) use ($now) {
                    $q->whereNull('start_date')->orWhere('start_date', '<=', $now);
                })
                ->where(function ($q) use ($now) {
                    $q->whereNull('end_date')->orWhere('end_date', '>=', $now);
                })
                ->where('applies_to_all_branches', true)
                ->where('applies_to_all_countries', true)
                ->orderByDesc('discount_percentage')
                ->first();

            $camps = SummerCamp::query()
                ->with(['branch.school', 'branch.city.country', 'tag'])
                ->where('visible', true)
                ->orderBy('name')
                ->limit(6)
                ->get(['id', 'branch_id', 'name', 'ar_name', 'age_range', 'fee_amount', 'thumbnail', 'tag_id', 'description', 'ar_description']);

            return $camps->map(function ($camp) use ($globalDiscount) {
                $basePrice = $camp->fee_amount !== null ? (float) $camp->fee_amount : null;
                $discountPct = $globalDiscount ? (float) $globalDiscount->discount_percentage : null;
                $discountedPrice = $basePrice;
                if ($basePrice !== null && $discountPct !== null) {
                    $discountedPrice = round($basePrice * (1 - ($discountPct / 100)), 2);
                }

                $baseCurrency = $camp->branch->city->country->currency_code ?? null;
                $sarPrice = null;
                $sarDiscounted = null;
                if ($baseCurrency && $basePrice !== null) {
                    $rate = ExchangeRate::where('base_currency', $baseCurrency)
                        ->where('target_currency', 'SAR')
                        ->value('rate');
                    $feePct = ConversionFee::where('base_currency', $baseCurrency)
                        ->where('target_currency', 'SAR')
                        ->value('fee');
                    $multiplier = $rate ? (float) $rate : null;
                    if ($multiplier) {
                        if ($feePct !== null) {
                            $multiplier *= (1 + ((float) $feePct / 100));
                        }
                        $sarPrice = round($basePrice * $multiplier, 2);
                        if ($discountedPrice !== null) {
                            $sarDiscounted = round($discountedPrice * $multiplier, 2);
                        }
                    }
                }

                return [
                    'id' => $camp->id,
                    'school' => $camp->branch->school->name ?? null,
                    'school_ar' => $camp->branch->school->ar_name ?? null,
                    'branch_location' => trim(($camp->branch->city->name ?? '') . ', ' . ($camp->branch->city->country->name ?? '')),
                    'branch_location_ar' => trim(($camp->branch->city->ar_name ?? '') . ', ' . ($camp->branch->city->country->ar_name ?? '')),
                    'branch_flag' => $camp->branch->city->country->flag ?? null,
                    'name' => $camp->name,
                    'ar_name' => $camp->ar_name,
                    'age_range' => $camp->age_range,
                    'description' => $camp->description,
                    'ar_description' => $camp->ar_description,
                    'thumbnail' => $camp->thumbnail,
                    'tag' => $camp->tag->name ?? null,
                    'tag_ar' => $camp->tag->ar_name ?? null,
                    'price' => [
                        'base_price' => $basePrice,
                        'currency' => $baseCurrency,
                        'converted_price' => $sarPrice,
                        'converted_currency' => $sarPrice ? 'SAR' : null,
                    ],
                    'discounted_price' => [
                        'base_price' => $discountedPrice,
                        'currency' => $baseCurrency,
                        'converted_price' => $sarDiscounted,
                        'converted_currency' => $sarDiscounted ? 'SAR' : null,
                        'discount_percentage' => $discountPct,
                    ],
                ];
            });
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function blogs()
    {
        $key = "api:home:blogs";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Blog::query()
                ->orderByDesc('published_at')
                ->orderByDesc('id')
                ->limit(6)
                ->get(['id', 'title', 'ar_title', 'summary', 'ar_summary', 'slug', 'featured_image', 'published_at', 'category_id'])
                ->load('category')
                ->map(function ($blog) {
                    return [
                        'id' => $blog->id,
                        'title' => $blog->title,
                        'ar_title' => $blog->ar_title,
                        'summary' => $blog->summary,
                        'ar_summary' => $blog->ar_summary,
                        'slug' => $blog->slug,
                        'featured_image' => $blog->featured_image,
                        'category' => $blog->category->name ?? null,
                        'category_ar' => $blog->category->ar_name ?? null,
                    ];
                });
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
    public function hero()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => 'Building Better Futures Through Education',
                'description' => 'We assist students in their journey to study abroad.',
                'image' => null
            ]
        ]);
    }

    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                ['label' => 'Students', 'value' => '500+'],
                ['label' => 'Universities', 'value' => '100+'],
                ['label' => 'Countries', 'value' => '20+'],
            ]
        ]);
    }

    public function contact()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'address' => '123 Education St, Knowledge City',
                'phone' => '+1234567890',
                'email' => 'info@pioneers.edu',
                'socialLinks' => [
                    ['platform' => 'Facebook', 'url' => '#'],
                    ['platform' => 'Instagram', 'url' => '#'],
                    ['platform' => 'LinkedIn', 'url' => '#']
                ]
            ]
        ]);
    }

    public function destinations()
    {
        // Full dummy data restored from frontend mocks as requested
        $data = [
            [
                'id' => 2,
                'slug' => 'uk',
                'name' => "United Kingdom",
                'countryCode' => 'gb',
                'description' => "Rich history of academic excellence and shorter degree duration.",
                'imageUrl' => "https://placehold.co/800x600?text=United Kingdom", // Using placeholder as local assets won't load from API domain without setup
                'features' => ["1-Year Master's", "Historic Campuses", "Post-Study Work Visa"],
                'shortPitch' => "Achieve a master's degree in just one year in the home of the English language.",
                'tuitionRange' => "£15,000 - £35,000 / year",
                'visaTimeline' => "3 weeks",
                'workRights' => "2 Years (Graduate Route)",
                'scholarships' => "Chevening & University Scholarships",
                'region' => "Europe",
                'stats' => [['label' => 'Universities', 'value' => '160+'], ['label' => 'Intl Students', 'value' => '600k+']]
            ],
            [
                'id' => 1,
                'slug' => 'usa',
                'name' => "United States",
                'countryCode' => 'us',
                'description' => "Home to Ivy League universities and diverse academic opportunities.",
                'imageUrl' => "https://placehold.co/800x600?text=United States",
                'features' => ["OPT Opportunities", "Top Global Rankings", "Flexible Curriculum"],
                'shortPitch' => "The ultimate study destination with world-renowned institutions and endless career possibilities.",
                'tuitionRange' => "$25,000 - $60,000 / year",
                'visaTimeline' => "3 - 8 weeks",
                'workRights' => "up to 3 Years (STEM OPT)",
                'scholarships' => "Merit-based & Athletic available",
                'region' => "North America",
                'stats' => [['label' => 'Universities', 'value' => '4000+'], ['label' => 'Intl Students', 'value' => '1M+']]
            ],
            [
                'id' => 3,
                'slug' => 'canada',
                'name' => "Canada",
                'countryCode' => 'ca',
                'description' => "Top academic standards, multicultural cities, and friendly immigration policies.",
                'imageUrl' => "https://placehold.co/800x600?text=Canada",
                'features' => ["PGWP available", "Multicultural Society", "Affordable Living"],
                'shortPitch' => "High academic standards and a welcoming environment for international students.",
                'tuitionRange' => "CAD 15,000 - 35,000 / year",
                'visaTimeline' => "8 - 12 weeks",
                'workRights' => "Up to 3 Years (PGWP)",
                'scholarships' => "Entrance & Merit-based",
                'region' => "North America",
                'stats' => [['label' => 'Universities', 'value' => '100+'], ['label' => 'Intl Students', 'value' => '800k+']]
            ],
            [
                'id' => 4,
                'slug' => 'australia',
                'name' => "Australia",
                'countryCode' => 'au',
                'description' => "World-class universities, laid-back lifestyle, and diverse post-study work opportunities.",
                'imageUrl' => "https://placehold.co/800x600?text=Australia",
                'features' => ["Post-study work visa", "High Quality of Life", "Research Focused"],
                'shortPitch' => "Experience world-class education with a laid-back lifestyle down under.",
                'tuitionRange' => "AUD 20,000 - 45,000 / year",
                'visaTimeline' => "4 - 8 weeks",
                'workRights' => "2-4 Years Post Study",
                'scholarships' => "Destination Australia",
                'region' => "Oceania",
                'stats' => [['label' => 'Universities', 'value' => '43'], ['label' => 'Intl Students', 'value' => '700k+']]
            ],
            [
                'id' => 5,
                'slug' => 'cyprus',
                'name' => "Cyprus",
                'countryCode' => 'cy',
                'description' => "Affordable education in a beautiful Mediterranean setting with EU standards.",
                'imageUrl' => "https://placehold.co/800x600?text=Cyprus",
                'features' => ["Affordable Tuition", "Easy Visa Process", "Mediterranean Lifestyle"],
                'shortPitch' => "Quality education at a fraction of the cost in a sunny European destination.",
                'tuitionRange' => "€3,000 - €8,000 / year",
                'visaTimeline' => "2 - 4 weeks",
                'workRights' => "Part-time allowed",
                'scholarships' => "Up to 50% available",
                'region' => "Europe",
                'stats' => [['label' => 'Universities', 'value' => '30+'], ['label' => 'Intl Students', 'value' => '25k+']]
            ],
            [
                'id' => 6,
                'slug' => 'hungary',
                'name' => "Hungary",
                'countryCode' => 'hu',
                'description' => "Historic universities in the heart of Europe with very low tuition fees.",
                'imageUrl' => "https://placehold.co/800x600?text=Hungary",
                'features' => ["Stipendium Hungaricum", "Low Cost of Living", "Central Europe"],
                'shortPitch' => "Study in the heart of Europe with full scholarships available.",
                'tuitionRange' => "€2,000 - €5,000 / year",
                'visaTimeline' => "4 - 8 weeks",
                'workRights' => "24 hours/week",
                'scholarships' => "Stipendium Hungaricum (Full)",
                'region' => "Europe",
                'stats' => [['label' => 'Universities', 'value' => '65'], ['label' => 'Intl Students', 'value' => '40k+']]
            ],
            [
                'id' => 7,
                'slug' => 'new-zealand',
                'name' => "New Zealand",
                'countryCode' => 'nz',
                'description' => "Innovative education system set in breathtaking natural landscapes.",
                'imageUrl' => "https://placehold.co/800x600?text=New Zealand",
                'features' => ["Post-study Work", "Safe Environment", "Practical Learning"],
                'shortPitch' => "A safe, welcoming country with a world-leading education system.",
                'tuitionRange' => "NZD 22,000 - 35,000 / year",
                'visaTimeline' => "3 - 6 weeks",
                'workRights' => "Up to 3 Years",
                'scholarships' => "Govt. Scholarships",
                'region' => "Oceania",
                'stats' => [['label' => 'Universities', 'value' => '8'], ['label' => 'Intl Students', 'value' => '100k+']]
            ],
            [
                'id' => 8,
                'slug' => 'denmark',
                'name' => "Denmark",
                'countryCode' => 'dk',
                'description' => "Innovative teaching methods and high standard of living in Scandinavia.",
                'imageUrl' => "https://placehold.co/800x600?text=Denmark",
                'features' => ["Innovation Focused", "English Programs", "High Wages"],
                'shortPitch' => "Study in one of the happiest and most innovative countries in the world.",
                'tuitionRange' => "€6,000 - €16,000 / year",
                'visaTimeline' => "8 - 10 weeks",
                'workRights' => "Part-time allowed",
                'scholarships' => "Government Scholarships",
                'region' => "Europe",
                'stats' => [['label' => 'Universities', 'value' => '8+'], ['label' => 'Intl Students', 'value' => '30k+']]
            ],
            [
                'id' => 9,
                'slug' => 'germany',
                'name' => "Germany",
                'countryCode' => 'de',
                'description' => "Tuition-free public universities and a powerhouse economy for engineering.",
                'imageUrl' => "https://placehold.co/800x600?text=Germany",
                'features' => ["Low/No Tuition", "Strong Economy", "Engineering Hub"],
                'shortPitch' => "Engineering excellence and low tuition fees in the heart of Europe.",
                'tuitionRange' => "€0 - €3,000 / year",
                'visaTimeline' => "6 - 10 weeks",
                'workRights' => "18 months Job Seeker",
                'scholarships' => "DAAD",
                'region' => "Europe",
                'stats' => [['label' => 'Universities', 'value' => '400+'], ['label' => 'Intl Students', 'value' => '350k+']]
            ]
        ];

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function testimonials()
    {
        return $this->reviews();
    }

    public function processSteps()
    {
        return response()->json([
            'success' => true,
            'data' => [
                ['title' => 'Consultation', 'description' => 'Meet our experts.'],
                ['title' => 'Application', 'description' => 'We help you apply.'],
                ['title' => 'Visa', 'description' => 'Guidance for visa process.'],
            ]
        ]);
    }

    public function benefits()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'Expert Guidance',
                'Global Network',
                'Comprehensive Support'
            ]
        ]);
    }

    public function trustPartners()
    {
        return response()->json([
            'success' => true,
            'data' => []
        ]);
    }

    public function scholarships(Request $request)
    {
        $query = \App\Models\UniversityScholarship::query()
            ->with(['university.country']);

        if ($request->filled('destination')) {
            // destination might be country name or ID. API usually standardizes on ID, but frontend sends param.
            // publicData says `destination` is mapped from queryFilters.destination.
            // Usually string name for now? Or ID? logic in publicData.ts line 293 uses country_id for uni search.
            // But for scholarships line 432 sends `destination`.
            // Let's filter by country name match if string.
            $dest = $request->destination;
            $query->whereHas('university.country', function ($q) use ($dest) {
                $q->where('name', 'like', "%{$dest}%");
            });
        }

        if ($request->filled('keyword')) {
            $query->where('title', 'like', "%{$request->keyword}%");
        }

        $items = $query->paginate($request->input('pageSize', 10));

        return response()->json([
            'success' => true,
            'data' => $items->items(),
            'meta' => [
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
            ]
        ]);
    }
}
