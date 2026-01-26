<?php

namespace App\Http\Controllers;

use App\Models\ConversionFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConversionFeeController extends Controller
{
    public function index(): View
    {
        $fees = ConversionFee::orderBy('base_currency')->orderBy('target_currency')->paginate(25);

        return view('admin.conversion.index', compact('fees'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'base_currency' => ['required', 'string', 'size:3'],
            'target_currency' => ['required', 'string', 'size:3', 'different:base_currency'],
            'fee' => ['required', 'numeric', 'min:0'],
        ]);

        ConversionFee::updateOrCreate(
            [
                'base_currency' => strtoupper($data['base_currency']),
                'target_currency' => strtoupper($data['target_currency']),
            ],
            ['fee' => $data['fee']]
        );

        return redirect()->route('admin.conversion.index')->with('success', 'Conversion fee saved.');
    }

    public function destroy(int $id): RedirectResponse
    {
        ConversionFee::where('id', $id)->delete();

        return redirect()->route('admin.conversion.index')->with('success', 'Conversion fee removed.');
    }
}
