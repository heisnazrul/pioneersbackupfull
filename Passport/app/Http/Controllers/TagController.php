<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::query()
            ->orderBy('display_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        Tag::create($data);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', [
            'tag' => $tag,
        ]);
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $data = $this->validateData($request, $tag);

        $tag->update($data);

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()
            ->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully.');
    }

    private function validateData(Request $request, ?Tag $tag = null): array
    {
        $id = $tag?->id;

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ar_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ar_description' => ['nullable', 'string'],
            'color' => ['nullable', 'regex:/^#([0-9A-Fa-f]{6})$/'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['display_order'] = $request->input('display_order', 0) ?? 0;

        return $data;
    }
}
