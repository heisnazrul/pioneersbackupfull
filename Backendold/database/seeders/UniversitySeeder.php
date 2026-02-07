<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\University;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        University::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $uk = Country::where('country_code', 'GB')->first();

        if (!$uk) {
            $this->command->error('UK Country not found. Please seed countries first.');
            return;
        }

        $universities = [
            [
                'name' => 'Bloomsbury Institute',
                'city_name' => 'London', // Map to London
                'type' => 'private',
                'website' => 'https://www.bil.ac.uk',
                'established_year' => 2002,
                'rank' => null, // Not typically in global QS top lists easily found, but high student satisfaction
                'famous_for' => 'Ranked #1 for Student Satisfaction in London (Law & Business). Known for personalized support and Birkbeck validation.',
                'fees' => 'Undergraduate: ~£12,000 - £16,500 per year (International).',
                'logo' => null, // Placeholder or fetch if possible, but null for now
            ],
            [
                'name' => 'University of Edinburgh',
                'city_name' => 'Edinburgh',
                'type' => 'public',
                'website' => 'https://www.ed.ac.uk',
                'established_year' => 1583,
                'rank' => 22,
                'famous_for' => 'One of Scotland’s ancient universities. Famous for Medicine, Sciences, and Humanities (Dolly the Sheep).',
                'fees' => 'International: £26,500 - £37,500 per year.',
            ],
            [
                'name' => 'University of Glasgow',
                'city_name' => 'Glasgow',
                'type' => 'public',
                'website' => 'https://www.gla.ac.uk',
                'established_year' => 1451,
                'rank' => 76,
                'famous_for' => 'Fourth oldest university in English-speaking world. Excellence in Medicine, Veterinary Medicine, and Engineering.',
                'fees' => 'International: £25,290 - £30,240 per year.',
            ],
            [
                'name' => 'Durham University',
                'city_name' => 'Durham', // Need to ensure Durham city exists
                'type' => 'public',
                'website' => 'https://www.durham.ac.uk',
                'established_year' => 1832,
                'rank' => 78,
                'famous_for' => 'Collegiate system (similar to Oxford/Cambridge). Strong in Theology, Archaeology, and Physics.',
                'fees' => 'International: £24,500 - £33,500 per year.',
            ],
            [
                'name' => 'University of Warwick',
                'city_name' => 'Coventry', // Warwick is main campus in Coventry
                'type' => 'public',
                'website' => 'https://warwick.ac.uk',
                'established_year' => 1965,
                'rank' => 67,
                'famous_for' => 'Warwick Business School (WBS), Economics, and strong industry links.',
                'fees' => 'International: £24,800 - £31,620 per year.',
            ],
        ];

        foreach ($universities as $uniData) {
            // Find or Create City
            $city = City::firstOrCreate(
                [
                    'name' => $uniData['city_name'],
                    'country_id' => $uk->id
                ],
                [
                    'name' => $uniData['city_name'],
                    'slug' => Str::slug($uniData['city_name']),
                    'country_id' => $uk->id,
                    'is_active' => true,
                    'ar_name' => $uniData['city_name'] . ' (AR)',
                ]
            );

            $university = University::withTrashed()->where('name', $uniData['name'])->first();

            if ($university) {
                $university->restore();
                $university->update([
                    'country_id' => $uk->id,
                    'city_id' => $city->id,
                    'type' => $uniData['type'],
                    'website' => $uniData['website'],
                    'established_year' => $uniData['established_year'],
                    'rank' => $uniData['rank'],
                    'famous_for' => $uniData['famous_for'],
                    'fees' => $uniData['fees'],
                    'is_active' => true,
                    'is_featured' => true,
                ]);
            } else {
                University::create([
                    'name' => $uniData['name'],
                    'slug' => Str::slug($uniData['name']),
                    'country_id' => $uk->id,
                    'city_id' => $city->id,
                    'type' => $uniData['type'],
                    'website' => $uniData['website'],
                    'established_year' => $uniData['established_year'],
                    'rank' => $uniData['rank'],
                    'famous_for' => $uniData['famous_for'],
                    'fees' => $uniData['fees'],
                    'is_active' => true,
                    'is_featured' => true,
                ]);
            }
        }
    }
}
