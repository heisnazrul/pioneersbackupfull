<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CmsController extends Controller
{
    public function courseEnglish(): View
    {
        return $this->indexByApp('courseenglish', 'CourseEnglish CMS');
    }

    public function university(): View
    {
        return $this->indexByApp('university', 'University CMS');
    }

    public function create(string $app): View
    {
        return view('admin.cms.create', [
            'app' => $app,
            'page' => new CmsPage(['app' => $app]),
        ]);
    }

    public function store(Request $request, string $app): RedirectResponse
    {
        $data = $this->validateData($request, $app);
        CmsPage::create($data);

        return redirect()->route($app === 'courseenglish' ? 'admin.cms.course-english' : 'admin.cms.university')
            ->with('success', 'Page created successfully');
    }

    public function edit(CmsPage $page): View
    {
        return view('admin.cms.edit', [
            'app' => $page->app,
            'page' => $page,
        ]);
    }

    public function update(Request $request, CmsPage $page): RedirectResponse
    {
        $data = $this->validateData($request, $page->app, $page);
        $page->update($data);

        return redirect()->route($page->app === 'courseenglish' ? 'admin.cms.course-english' : 'admin.cms.university')
            ->with('success', 'Page updated successfully');
    }

    public function destroy(CmsPage $page): RedirectResponse
    {
        $app = $page->app;
        $page->delete();

        return redirect()->route($app === 'courseenglish' ? 'admin.cms.course-english' : 'admin.cms.university')
            ->with('success', 'Page deleted successfully');
    }

    private function indexByApp(string $app, string $title): View
    {
        $pages = CmsPage::forApp($app)
            ->orderBy('display_order')
            ->orderBy('title')
            ->get();

        return view('admin.cms.index', [
            'title' => $title,
            'app' => $app,
            'pages' => $pages,
        ]);
    }

    private function validateData(Request $request, string $app, ?CmsPage $page = null): array
    {
        return $request->validate([
            'slug' => ['required', 'string', 'max:160', 'unique:cms_pages,slug,'.($page->id ?? 'null').',id,app,'.$app],
            'title' => ['required', 'string', 'max:255'],
            'ar_title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'ar_content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]) + ['app' => $app, 'is_active' => $request->boolean('is_active', true), 'display_order' => $request->input('display_order', 0)];
    }
}
