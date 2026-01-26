<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalCitySeeder extends Seeder
{
    public function run(): void
    {
        // Map city name to country name for lookup
        $cities = [
            'Scarborough' => 'United Kingdom',
            'Galway' => 'Ireland',
            'Bath' => 'United Kingdom',
            'Liverpool' => 'United Kingdom',
            'Brighton' => 'United Kingdom',
            'Bournemouth' => 'United Kingdom',
            'Cape Town' => 'South Africa',
            'Cyprus (Limassol)' => 'Cyprus',
            'Dublin' => 'Ireland',
            'Cork' => 'Ireland',
            'Worthing' => 'United Kingdom',
            'Canterbury' => 'United Kingdom',
            'Southampton' => 'United Kingdom',
            'Reading' => 'United Kingdom',
            'Bristol' => 'United Kingdom',
            'Cheltenham' => 'United Kingdom',
            'Cambridge' => 'United Kingdom',
            'Colchester' => 'United Kingdom',
            'Portsmouth' => 'United Kingdom',
            'centre of Leeds (probably should just be Leeds)' => 'United Kingdom',
            'Leeds' => 'United Kingdom',
            'Eastbourne' => 'United Kingdom',
            'York' => 'United Kingdom',
            'Malta' => 'Malta',
            'Oxford' => 'United Kingdom',
            'Preston' => 'United Kingdom',
            'Berkeley' => 'United States',
            'San Diego' => 'United States',
            'Paris' => 'France',
            'Zurich' => 'Switzerland',
        ];

        $countryIds = DB::table('countries')->pluck('id', 'name');
        $existingCities = DB::table('cities')->pluck('id', 'name');
        $existingCountryCodes = DB::table('countries')->pluck('country_code', 'name');

        $insert = [];
        $order = DB::table('cities')->max('display_order') ?? 0;

        foreach ($cities as $cityName => $countryName) {
            if (isset($existingCities[$cityName])) {
                continue;
            }

            if (! isset($countryIds[$countryName])) {
                // Insert missing country with minimal data
                $placeholderFlag = 'assets/flags/placeholder.svg';
                $placeholderCurrency = 'XXX';

                $newCountryId = DB::table('countries')->insertGetId([
                    'name' => $countryName,
                    'ar_name' => $countryName,
                    'flag' => $placeholderFlag,
                    'country_code' => strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $countryName), 0, 3)) ?: null,
                    'currency_code' => $placeholderCurrency,
                    'phone_code' => null,
                    'description' => null,
                    'ar_description' => null,
                    'capital' => null,
                    'continent' => null,
                    'display_order' => (DB::table('countries')->max('display_order') ?? 0) + 1,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $countryIds[$countryName] = $newCountryId;
            }

            $order++;
            $insert[] = [
                'name' => $cityName,
                'ar_name' => $cityName,
                'country_id' => $countryIds[$countryName],
                'description' => null,
                'ar_description' => null,
                'latitude' => null,
                'longitude' => null,
                'display_order' => $order,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (! empty($insert)) {
            DB::table('cities')->insert($insert);
        }
    }
}
