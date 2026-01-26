<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DestinationController extends Controller
{
    public function index(): View
    {
        $destinations = Destination::with('country')->orderBy('name')->paginate(20);
        return view('admin.destinations.index', compact('destinations'));
    }

    public function create(): View
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.destinations.create', compact('countries'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinations',
            'country_id' => 'required|exists:countries,id',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_pitch' => 'nullable|string',
            'tuition_range' => 'nullable|string',
            'visa_timeline' => 'nullable|string',
            'work_rights' => 'nullable|string',
            'scholarships_summary' => 'nullable|string',
            'is_active' => 'boolean',
            'features.*' => 'nullable|string',
            'stats.*.label' => 'nullable|string',
            'stats.*.value' => 'nullable|string',
            'intakes.*.month' => 'nullable|string',
            'intakes.*.event' => 'nullable|string',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'requirements.*' => 'nullable|string',
            'disciplines.*' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('destinations', 'public');
            $validated['image_url'] = $path;
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $request) {
            $destination = Destination::create($validated);

            if ($request->has('features')) {
                foreach ($request->features as $feature) {
                    if (!empty($feature))
                        $destination->features()->create(['feature' => $feature]);
                }
            }

            if ($request->has('stats')) {
                foreach ($request->stats as $stat) {
                    if (!empty($stat['label']) && !empty($stat['value'])) {
                        $destination->stats()->create($stat);
                    }
                }
            }

            if ($request->has('intakes')) {
                foreach ($request->intakes as $intake) {
                    if (!empty($intake['month']) && !empty($intake['event'])) {
                        $destination->intakes()->create($intake);
                    }
                }
            }

            if ($request->has('faqs')) {
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $destination->faqs()->create($faq);
                    }
                }
            }

            if ($request->has('requirements')) {
                foreach ($request->requirements as $requirement) {
                    if (!empty($requirement))
                        $destination->requirements()->create(['requirement' => $requirement]);
                }
            }

            if ($request->has('disciplines')) {
                foreach ($request->disciplines as $discipline) {
                    if (!empty($discipline))
                        $destination->disciplines()->create(['discipline' => $discipline]);
                }
            }
        });

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination): View
    {
        $destination->load(['features', 'stats', 'intakes', 'faqs', 'requirements', 'disciplines']);
        $countries = Country::orderBy('name')->get();
        return view('admin.destinations.edit', compact('destination', 'countries'));
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:destinations,slug,' . $destination->id,
            'country_id' => 'required|exists:countries,id',
            'region' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'short_pitch' => 'nullable|string',
            'tuition_range' => 'nullable|string',
            'visa_timeline' => 'nullable|string',
            'work_rights' => 'nullable|string',
            'scholarships_summary' => 'nullable|string',
            'is_active' => 'boolean',
            'features.*' => 'nullable|string',
            'stats.*.label' => 'nullable|string',
            'stats.*.value' => 'nullable|string',
            'intakes.*.month' => 'nullable|string',
            'intakes.*.event' => 'nullable|string',
            'faqs.*.question' => 'nullable|string',
            'faqs.*.answer' => 'nullable|string',
            'requirements.*' => 'nullable|string',
            'disciplines.*' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($destination->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($destination->image_url)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($destination->image_url);
            }
            $path = $request->file('image')->store('destinations', 'public');
            $validated['image_url'] = $path;
        }

        if (!$request->has('is_active')) {
            $validated['is_active'] = 0;
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($destination, $validated, $request) {
            $destination->update($validated);

            // Sync features
            $destination->features()->delete();
            if ($request->has('features')) {
                foreach ($request->features as $feature) {
                    if (!empty($feature))
                        $destination->features()->create(['feature' => $feature]);
                }
            }

            // Sync stats
            $destination->stats()->delete();
            if ($request->has('stats')) {
                foreach ($request->stats as $stat) {
                    if (!empty($stat['label']) && !empty($stat['value'])) {
                        $destination->stats()->create($stat);
                    }
                }
            }

            // Sync intakes
            $destination->intakes()->delete();
            if ($request->has('intakes')) {
                foreach ($request->intakes as $intake) {
                    if (!empty($intake['month']) && !empty($intake['event'])) {
                        $destination->intakes()->create($intake);
                    }
                }
            }

            // Sync faqs
            $destination->faqs()->delete();
            if ($request->has('faqs')) {
                foreach ($request->faqs as $faq) {
                    if (!empty($faq['question']) && !empty($faq['answer'])) {
                        $destination->faqs()->create($faq);
                    }
                }
            }

            // Sync requirements
            $destination->requirements()->delete();
            if ($request->has('requirements')) {
                foreach ($request->requirements as $requirement) {
                    if (!empty($requirement))
                        $destination->requirements()->create(['requirement' => $requirement]);
                }
            }

            // Sync disciplines
            $destination->disciplines()->delete();
            if ($request->has('disciplines')) {
                foreach ($request->disciplines as $discipline) {
                    if (!empty($discipline))
                        $destination->disciplines()->create(['discipline' => $discipline]);
                }
            }
        });

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($destination) {
                // Delete image from storage if exists
                if ($destination->image_url && \Illuminate\Support\Facades\Storage::disk('public')->exists($destination->image_url)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($destination->image_url);
                }

                // Delete the record (cascade will handle related tables, but explicit is safer if not set in DB)
                // Assuming DB has ON DELETE CASCADE for related tables as seen in migration
                $destination->delete();
            });

            return redirect()->route('admin.destinations.index')
                ->with('success', 'Destination deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.destinations.index')
                ->with('error', 'Failed to delete destination: ' . $e->getMessage());
        }
    }
}
