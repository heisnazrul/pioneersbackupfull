<?php

namespace App\Http\Controllers;

use App\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeRateController extends Controller
{
    public function index()
    {
        $rates = ExchangeRate::orderBy('base_currency')->orderBy('target_currency')->paginate(25);

        return view('admin.rates.index', compact('rates'));
    }

    public function getGbpAllRates()
    {
        $baseCurrency = 'GBP';
        $targetCurrencies = [
            'INR', 'CNY', 'JPY', 'PKR', 'BDT', 'ZAR', 'SGD', 'SAR', 'KWD', 'OMR',
            'BHD', 'QAR', 'EGP', 'LYD', 'IRR', 'MYR', 'THB', 'IDR', 'PHP', 'VND',
            'KOR', 'TWD', 'AUD', 'NZD', 'AFN', 'LKR', 'USD', 'EUR', 'CAD', 'CHF', 'AED',
        ];

        $response = Http::get("https://v6.exchangerate-api.com/v6/b48ba6de70457ee823d7fe7f/latest/{$baseCurrency}");

        if ($response->successful()) {
            $rates = $response->json()['conversion_rates'] ?? [];
            foreach ($targetCurrencies as $targetCurrency) {
                if (isset($rates[$targetCurrency])) {
                    ExchangeRate::updateOrCreate(
                        ['base_currency' => $baseCurrency, 'target_currency' => $targetCurrency],
                        ['rate' => $rates[$targetCurrency]]
                    );
                }
            }

            return redirect()->route('admin.rates.index')->with('success', 'Rates updated successfully.');
        }

        return redirect()->route('admin.rates.index')->with('error', 'Failed to fetch rates.');
    }
}
