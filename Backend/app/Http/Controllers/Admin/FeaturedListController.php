<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeaturedList;
use Illuminate\Http\Request;

class FeaturedListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = FeaturedList::orderBy('name')->paginate(10);
        return view('admin.featured_lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.featured_lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:80|unique:featured_lists,key',
            'name' => 'required|string|max:120',
            'is_active' => 'boolean',
        ]);

        FeaturedList::create($validated);

        return redirect()->route('admin.featured-lists.index')->with('success', 'Featured List created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeaturedList $featuredList)
    {
        return view('admin.featured_lists.edit', compact('featuredList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeaturedList $featuredList)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:80|unique:featured_lists,key,' . $featuredList->id,
            'name' => 'required|string|max:120',
            'is_active' => 'boolean',
        ]);

        $featuredList->update($validated);

        return redirect()->route('admin.featured-lists.index')->with('success', 'Featured List updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeaturedList $featuredList)
    {
        $featuredList->delete();

        return redirect()->route('admin.featured-lists.index')->with('success', 'Featured List deleted successfully.');
    }
}
