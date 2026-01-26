<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function universityHome()
    {
        $heroRecord = \App\Models\UniversityCms::where('section', 'hero')->first();
        $hero = $heroRecord ? $heroRecord->content : [];

        $statsRecord = \App\Models\UniversityCms::where('section', 'stats')->first();
        $stats = $statsRecord ? $statsRecord->content : [];

        $certificatesRecord = \App\Models\UniversityCms::where('section', 'certificates')->first();
        $certificates = $certificatesRecord ? $certificatesRecord->content : [];

        $destinationsRecord = \App\Models\UniversityCms::where('section', 'destinations')->first();
        $destinations = $destinationsRecord ? $destinationsRecord->content : [];

        $reviewsRecord = \App\Models\UniversityCms::where('section', 'reviews')->first();
        $reviews = $reviewsRecord ? $reviewsRecord->content : [];

        $blogsRecord = \App\Models\UniversityCms::where('section', 'blogs')->first();
        $blogs = $blogsRecord ? $blogsRecord->content : [];

        $whyChooseRecord = \App\Models\UniversityCms::where('section', 'why_choose')->first();
        $whyChoose = $whyChooseRecord ? $whyChooseRecord->content : [];

        // Temporary placeholder for other sections until refactored
        $universities = \App\Models\Setting::get('cms_university_universities', []);
        $videoReviews = \App\Models\Setting::get('cms_university_video_reviews', []);
        $other = \App\Models\Setting::get('cms_university_other', []);

        return view('admin.cms.university.home', compact('hero', 'stats', 'certificates', 'destinations', 'reviews', 'blogs', 'whyChoose', 'universities', 'videoReviews', 'other'));
    }

    public function updateUniversityHome(Request $request, $section)
    {
        // Handle mapped CMS sections
        if (in_array($section, ['hero', 'stats', 'certificates', 'destinations', 'reviews', 'blogs', 'why_choose'])) {
            $data = $request->except(['_token', '_method']);

            // Handle file uploads
            foreach ($request->allFiles() as $fileKey => $file) {
                $path = $file->store('cms/university', 'public');
                $data[$fileKey] = $path;
            }

            // Fetch existing to merge
            $record = \App\Models\UniversityCms::where('section', $section)->first();
            $existing = $record ? $record->content : [];
            $data = array_merge($existing, $data);

            \App\Models\UniversityCms::updateOrCreate(
                ['section' => $section],
                ['content' => $data]
            );

            return redirect()->back()->with('success', ucfirst($section) . ' Section updated successfully.');
        }

        // Fallback for other sections (legacy Setting model)
        $key = 'cms_university_' . $section;
        $data = $request->except(['_token', '_method']);
        foreach ($request->allFiles() as $fileKey => $file) {
            $path = $file->store('cms/university', 'public');
            $data[$fileKey] = $path;
        }
        $existing = \App\Models\Setting::get($key, []);
        $data = array_merge($existing, $data);
        \App\Models\Setting::put($key, $data);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    public function courseEnglishIndex()
    {
        return view('admin.cms.course-english.index');
    }
}
