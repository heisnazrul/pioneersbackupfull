<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoReviewController extends Controller
{
    public function index()
    {
        $reviews = VideoReview::latest()->paginate(10);
        return view('admin.video_reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.video_reviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'university_name' => 'nullable|string|max:255',
            'country_name' => 'nullable|string|max:255',
            'review_text' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('video_reviews/thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        VideoReview::create($validated);

        return redirect()->route('admin.video-reviews.index')->with('success', 'Video Review added successfully.');
    }

    public function edit(VideoReview $videoReview)
    {
        return view('admin.video_reviews.edit', compact('videoReview'));
    }

    public function update(Request $request, VideoReview $videoReview)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'course_name' => 'nullable|string|max:255',
            'university_name' => 'nullable|string|max:255',
            'country_name' => 'nullable|string|max:255',
            'review_text' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($videoReview->thumbnail && Storage::disk('public')->exists($videoReview->thumbnail)) {
                Storage::disk('public')->delete($videoReview->thumbnail);
            }
            $path = $request->file('thumbnail')->store('video_reviews/thumbnails', 'public');
            $validated['thumbnail'] = $path;
        }

        $videoReview->update($validated);

        return redirect()->route('admin.video-reviews.index')->with('success', 'Video Review updated successfully.');
    }

    public function destroy(VideoReview $videoReview)
    {
        if ($videoReview->thumbnail && Storage::disk('public')->exists($videoReview->thumbnail)) {
            Storage::disk('public')->delete($videoReview->thumbnail);
        }
        $videoReview->delete();
        return redirect()->route('admin.video-reviews.index')->with('success', 'Video Review deleted successfully.');
    }
}
