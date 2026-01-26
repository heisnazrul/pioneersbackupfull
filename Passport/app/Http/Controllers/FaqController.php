<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::query()
            ->orderBy('category')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('admin.faqs.index', [
            'faqs' => $faqs,
        ]);
    }

    public function create(): View
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);

        Faq::create($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', [
            'faq' => $faq,
        ]);
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $data = $this->validateData($request);

        $faq->update($data);

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()
            ->route('admin.faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'category' => ['required', 'string', 'max:255'],
            'ar_category' => ['nullable', 'string', 'max:255'],
            'question' => ['required', 'string'],
            'ar_question' => ['nullable', 'string'],
            'answer' => ['required', 'string'],
            'ar_answer' => ['nullable', 'string'],
        ]);
    }
}

