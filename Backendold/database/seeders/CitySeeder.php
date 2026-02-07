<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $countries = Country::all();

        foreach ($countries as $country) {
            $limit = $country->is_popular ? 20 : 10;

            // Hardcoded lists for top popular countries to be realistic as requested
            $realCities = match ($country->country_code) {
                'GB' => ['London', 'Edinburgh', 'Manchester', 'Birmingham', 'Glasgow', 'Liverpool', 'Bristol', 'Oxford', 'Cambridge', 'Leeds', 'Newcastle', 'Sheffield', 'Belfast', 'Cardiff', 'Nottingham', 'Southampton', 'Leicester', 'Coventry', 'Bradford', 'Stoke'],
                'US' => ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose', 'Austin', 'Jacksonville', 'Fort Worth', 'Columbus', 'Charlotte', 'San Francisco', 'Indianapolis', 'Seattle', 'Denver', 'Washington'],
                'CA' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Edmonton', 'Ottawa', 'Winnipeg', 'Quebec City', 'Hamilton', 'Kitchener', 'London', 'Victoria', 'Halifax', 'Oshawa', 'Windsor', 'Saskatoon', 'Regina', 'St. John\'s', 'Barrie', 'Kelowna'],
                'AU' => ['Sydney', 'Melbourne', 'Brisbane', 'Perth', 'Adelaide', 'Gold Coast', 'Canberra', 'Newcastle', 'Sunshine Coast', 'Wollongong', 'Geelong', 'Hobart', 'Townsville', 'Cairns', 'Darwin', 'Toowoomba', 'Ballarat', 'Bendigo', 'Albury', 'Launceston'],
                default => [], // For others, use Faker or simple generated names
            };

            // Insert Real Cities first
            foreach ($realCities as $cityName) {
                City::firstOrCreate(
                    [
                        'name' => $cityName,
                        'country_id' => $country->id,
                    ],
                    [
                        'ar_name' => 'مدينة ' . $cityName, // Simple arabic placeholder
                        'is_active' => true,
                        //'slug' => handled by model boot
                    ]
                );
            }

            // Fill the rest with Faker if needed to reach exactly the limit (or if no real cities)
            $currentCount = count($realCities);
            if ($currentCount < $limit) {
                for ($i = $currentCount; $i < $limit; $i++) {
                    $name = $faker->city;
                    City::create([
                        'name' => $name,
                        'ar_name' => 'مدينة ' . $name,
                        'country_id' => $country->id,
                        'is_active' => true,
                    ]);
                }
            }
        }
    }
}
