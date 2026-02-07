<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CmsPageController extends Controller
{
    public function index()
    {
        $pages = \App\Models\CmsPage::all();
        return view('admin.cms_pages.index', compact('pages'));
    }

    public function edit(\App\Models\CmsPage $cmsPage)
    {
        $viewData = compact('cmsPage');

        if ($cmsPage->slug === 'student-guide') {
            $viewData['blogCategories'] = \App\Models\BlogCategory::all();
        }

        return view('admin.cms_pages.edit', $viewData);
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\CmsPage $cmsPage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'content' => 'required|array',
        ]);

        $data = $request->all();
        $content = $data['content'];

        // Helper function for file upload
        $uploadFile = function ($file, $path) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            return url($path . '/' . $filename);
        };

        // Process Director Image
        if ($request->hasFile('director_image')) {
            $content['director_message']['image'] = $uploadFile($request->file('director_image'), 'uploads/cms');
        }

        // Process CEO Image
        if ($request->hasFile('ceo_image')) {
            $content['ceo_message']['image'] = $uploadFile($request->file('ceo_image'), 'uploads/cms');
        }

        // Process Team Member Images
        if (isset($content['team']['members'])) {
            foreach ($content['team']['members'] as $index => &$member) {
                // Check if a file was uploaded for this member index
                // Note: File inputs for arrays are tricky. We used name="team_members_{index}_image" in the view.
                $fileKey = "team_members_{$index}_image";
                if ($request->hasFile($fileKey)) {
                    $member['image'] = $uploadFile($request->file($fileKey), 'uploads/cms');
                }
            }
        }

        // Process Contact Page Office Images
        if (isset($content['offices'])) {
            foreach ($content['offices'] as $index => &$office) {
                $fileKey = "contact_offices_{$index}_image";
                if ($request->hasFile($fileKey)) {
                    $office['image'] = $uploadFile($request->file($fileKey), 'uploads/cms');
                }
            }
        }

        // Process raw paragraphs for Director Message
        if ($request->has('director_paragraphs_raw')) {
            $content['director_message']['paragraphs'] = array_values(array_filter(array_map('trim', explode("\n", $request->input('director_paragraphs_raw')))));
        }

        // Process raw paragraphs for CEO Message
        if ($request->has('ceo_paragraphs_raw')) {
            $content['ceo_message']['paragraphs'] = array_values(array_filter(array_map('trim', explode("\n", $request->input('ceo_paragraphs_raw')))));
        }

        $data['content'] = $content;
        $cmsPage->update($data);

        return redirect()->route('admin.cms-pages.index')
            ->with('success', 'Page updated successfully.');
    }

}
