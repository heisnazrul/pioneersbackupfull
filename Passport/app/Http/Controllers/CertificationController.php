<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.certifications.index', [
            'certifications' => $certifications,
        ]);
    }
    public function create(): View
    {
        return view('admin.certifications.create');
    }
    public function edit(Certification $certification): View
    {
        return view('admin.certifications.create', [
            'certification' => $certification,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'subtitle'            => 'nullable|string',
            'ar_title'            => 'nullable|string',
            'ar_subtitle'         => 'nullable|string',
            'certificate_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certification_link'  => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('certificate_image')) {
            $data['certificate_image'] = $request
                ->file('certificate_image')
                ->store('certificates', 'public');
        }

        Certification::create($data);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification created successfully.');
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title'               => 'required|string|max:255',
            'subtitle'            => 'nullable|string',
            'ar_title'            => 'nullable|string',
            'ar_subtitle'         => 'nullable|string',
            'certificate_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'certification_link'  => 'nullable|url|max:255',
        ]);

        if ($request->hasFile('certificate_image')) {
            if ($certification->certificate_image) {
                Storage::disk('public')->delete($certification->certificate_image);
            }
            $data['certificate_image'] = $request
                ->file('certificate_image')
                ->store('certificates', 'public');
        }

        $certification->update($data);

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->certificate_image) {
            Storage::disk('public')->delete($certification->certificate_image);
        }

        $certification->delete();

        return redirect()
            ->route('admin.certifications.index')
            ->with('success', 'Certification deleted successfully.');
    }
}
