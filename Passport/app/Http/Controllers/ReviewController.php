<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::orderByDesc('id')->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => ['required','string','max:255'],
            'ar_name'           => ['nullable','string','max:255'],
            'photo'             => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:4096'],
            'institute_name'    => ['nullable','string','max:255'],
            'ar_institute_name' => ['nullable','string','max:255'],
            'title'             => ['nullable','string','max:255'],
            'ar_title'          => ['nullable','string','max:255'],
            'review_text'       => ['nullable','string'],
            'ar_review_text'    => ['nullable','string'],
            'gender'            => ['nullable', Rule::in(['male','female','other'])],
            'rating'            => ['required','integer','min:1','max:5'],
            'facebook_link'     => ['nullable','url'],
            'twitter_link'      => ['nullable','url'],
            'instagram_link'    => ['nullable','url'],
            'linkedin_link'     => ['nullable','url'],
            'screenshots.*'     => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:4096'],
            'video'             => ['nullable','url','max:255'],
            'is_approved'       => ['nullable','boolean'],
        ]);

        // Uploads
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('reviews/photos', 'public');
        }

        if ($request->hasFile('screenshots')) {
            $paths = [];
            foreach ($request->file('screenshots') as $shot) {
                $paths[] = $shot->store('reviews/screenshots', 'public');
            }
            $validated['screenshots'] = json_encode($paths);
        }

        $validated['is_approved'] = $request->boolean('is_approved');

        Review::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(Review $review)
    {
        $cities = City::orderBy('name')->get();
        // Decode screenshots for display
        $existingScreens = is_array($review->screenshots)
            ? $review->screenshots
            : ( $review->screenshots ? json_decode($review->screenshots, true) : [] );

        return view('admin.reviews.edit', compact('review','cities','existingScreens'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name'              => ['required','string','max:255'],
            'ar_name'           => ['nullable','string','max:255'],
            'photo'             => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:4096'],
            'institute_name'    => ['nullable','string','max:255'],
            'ar_institute_name' => ['nullable','string','max:255'],

            'title'             => ['nullable','string','max:255'],
            'ar_title'          => ['nullable','string','max:255'],
            'review_text'       => ['nullable','string'],
            'ar_review_text'    => ['nullable','string'],
            'gender'            => ['nullable', Rule::in(['male','female','other'])],
            'rating'            => ['required','integer','min:1','max:5'],
            'facebook_link'     => ['nullable','url'],
            'twitter_link'      => ['nullable','url'],
            'instagram_link'    => ['nullable','url'],
            'linkedin_link'     => ['nullable','url'],
            'screenshots.*'     => ['nullable','image','mimes:jpeg,png,jpg,gif,webp','max:4096'],
            'video'             => ['nullable','url','max:255'],
            'is_approved'       => ['nullable','boolean'],
        ]);

        // Replace photo if a new one is uploaded
        if ($request->hasFile('photo')) {
            if ($review->photo) {
                Storage::disk('public')->delete($review->photo);
            }
            $validated['photo'] = $request->file('photo')->store('reviews/photos', 'public');
        }

        // If new screenshots uploaded, replace the set
        if ($request->hasFile('screenshots')) {
            // delete old shots
            if ($review->screenshots) {
                foreach ((array) json_decode($review->screenshots, true) as $old) {
                    Storage::disk('public')->delete($old);
                }
            }
            $paths = [];
            foreach ($request->file('screenshots') as $shot) {
                $paths[] = $shot->store('reviews/screenshots', 'public');
            }
            $validated['screenshots'] = json_encode($paths);
        }

        $validated['is_approved'] = $request->boolean('is_approved');

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        // Cleanup uploads
        if ($review->photo) {
            Storage::disk('public')->delete($review->photo);
        }
        if ($review->screenshots) {
            foreach ((array) json_decode($review->screenshots, true) as $old) {
                Storage::disk('public')->delete($old);
            }
        }

        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
