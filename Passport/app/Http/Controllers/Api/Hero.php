<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Country;
use App\Models\City;
use App\Models\School;
use App\Models\SchoolBranch;

class Hero extends Controller
{
    /** Cache TTL: 30 days */
    protected $cacheTtl;

    public function __construct()
    {
        $this->cacheTtl = now()->addDays(30);
    }

    public function countries(Request $request)
    {
        $locale = $request->get('locale', 'default');
        $key = "api:countries:{$locale}";

        $data = Cache::remember($key, $this->cacheTtl, function () {
            return Country::query()
                ->active()
                ->orderBy('display_order')
                ->get(['id', 'name', 'ar_name', 'slug', 'flag', 'country_code', 'currency_code', 'continent', 'is_popular']);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function cities(Request $request)
    {
        $countryId = $request->get('country_id');
        $locale = $request->get('locale', 'default');
        $key = "api:cities:country:{$countryId}:{$locale}";

        $data = Cache::remember($key, $this->cacheTtl, function () use ($countryId) {
            $query = City::query()->active()->with('country:id,country_code')->orderBy('display_order');
            if ($countryId) {
                $query->where('country_id', $countryId);
            }
            // Temporarily select all or specific fields including slug
            // Note: with() won't attach unless we assume the relationship exists.
            $cities = $query->get(['id', 'name', 'ar_name', 'slug', 'country_id']);

            // Map to Flatten if needed, or just return struct
            // For now, let's just return the structure and handle mapping in frontend
            return $cities;
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function schools(Request $request)
    {
        $q = $request->get('q');
        $locale = $request->get('locale', 'default');
        $key = "api:schools:q:" . md5($q ?? 'all') . ":{$locale}";

        $data = Cache::remember($key, $this->cacheTtl, function () use ($q) {
            $query = School::query()->orderBy('name');
            if ($q) {
                $query->where('name', 'like', "%{$q}%")->orWhere('ar_name', 'like', "%{$q}%");
            }
            return $query->get(['id', 'name', 'ar_name', 'slug', 'logo']);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function branches(Request $request)
    {
        $schoolId = $request->get('school_id');
        $cityId = $request->get('city_id');
        $locale = $request->get('locale', 'default');
        $key = "api:branches:school:{$schoolId}:city:{$cityId}:{$locale}";

        $data = Cache::remember($key, $this->cacheTtl, function () use ($schoolId, $cityId) {
            $query = SchoolBranch::query()->with(['school', 'city'])->orderBy('id');
            if ($schoolId) {
                $query->where('school_id', $schoolId);
            }
            if ($cityId) {
                $query->where('city_id', $cityId);
            }
            return $query->get(['id', 'school_id', 'city_id', 'slug', 'gallery_urls']);
        });

        return response()->json(['success' => true, 'data' => $data]);
    }
}


