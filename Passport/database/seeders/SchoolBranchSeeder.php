<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SchoolBranchSeeder extends Seeder
{
    public function run(): void
    {
        // Map: school name -> id
        $schoolIds = DB::table('schools')->pluck('id', 'name');

        // Map: city name -> id
        $cityIds = DB::table('cities')->pluck('id', 'name');

        // Define branches as school + list of cities
        $definitions = [
            [
                'school' => 'IH International House',
                'cities' => ['Bristol', 'London'],
            ],
            [
                'school' => 'The Bournemouth School of English',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Anglotec Academy',
                'cities' => ['Scarborough'],
            ],
            [
                'school' => 'Atlantic Centre of Education',
                'cities' => ['Galway'],
            ],
            [
                'school' => 'Bath Academy of English',
                'cities' => ['Bath'],
            ],
            [
                'school' => 'Bayswater',
                'cities' => [
                    'London',
                    'Liverpool',
                    'Brighton',
                    'Bournemouth',
                    'Vancouver',
                    'Toronto',
                    'Calgary',
                    'Paris',      // fixed “Pairs”
                    'Cape Town',
                    'Limassol',
                ],
            ],
            [
                'school' => 'Beet Language Centre',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Berlitz',
                'cities' => ['Manchester', 'London', 'Dublin'],
            ],
            [
                'school' => 'Bournemouth City College BCC',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Bright School of English',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Brighton Language College International',
                'cities' => ['Brighton'],
            ],
            [
                'school' => 'Britannia English Academy',
                'cities' => ['Manchester'],
            ],
            [
                'school' => 'BSC EDUCATION',
                'cities' => [
                    'Central London',
                    'Brighton',
                    'Manchester',
                    'York',
                    'Edinburgh', // fixed “Edinburg”
                    'Malta',
                ],
            ],
            [
                'school' => 'Burlington School',
                'cities' => ['London'],
            ],
            [
                'school' => 'Central Language School',
                'cities' => ['Cambridge'],
            ],
            [
                'school' => 'CES - Centre of English Studies',
                'cities' => ['London'],
            ],
            [
                'school' => 'Concorde International',
                'cities' => ['Canterbury', 'Kent'],
            ],
            [
                'school' => 'ETC International College',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Eurospeak Language School',
                'cities' => ['Southampton', 'Reading'],
            ],
            [
                'school' => 'ILC International Language Centres',
                'cities' => ['Birmingham', 'Bristol', 'Cambridge', 'Colchester', 'Portsmouth'],
            ],
            [
                'school' => 'Imagine English Liverpool Academy',
                'cities' => ['Liverpool'],
            ],
            [
                'school' => 'Inlingua',
                'cities' => ['Cheltenham'],
            ],
            [
                'school' => 'Islington Centre for English',
                'cities' => ['London'],
            ],
            [
                'school' => 'Kensington Academy of English',
                'cities' => ['London'],
            ],
            [
                'school' => 'Leeds Language College Ltd',
                'cities' => ['Leeds'],
            ],
            [
                'school' => 'Lewis School of English',
                'cities' => ['Southampton'],
            ],
            [
                'school' => 'LILA Language School',
                'cities' => ['Liverpool'],
            ],
            [
                'school' => 'Live Language School',
                'cities' => ['Glasgow'],
            ],
            [
                'school' => 'LSI Education',
                'cities' => ['London', 'Brighton', 'Cambridge'],
            ],
            [
                'school' => 'LSI/IH Portsmouth',
                'cities' => ['Portsmouth'],
            ],
            [
                'school' => 'MC Academy',
                'cities' => ['Manchester', 'Liverpool'],
            ],
            [
                'school' => 'Nacel English School London',
                'cities' => ['Finchley'],
            ],
            [
                'school' => 'NCG (New College Group)',
                'cities' => ['Manchester', 'Liverpool'],
            ],
            [
                'school' => 'Oxford International English Schools OIES',
                'cities' => ['Brighton'],
            ],
            [
                'school' => 'Oxford International Study Centre',
                'cities' => ['Oxford'],
            ],
            [
                'school' => 'Preston Academy of English',
                'cities' => ['Preston'],
            ],
            [
                'school' => 'Select English Cambridge',
                'cities' => ['Cambridge'],
            ],
            [
                'school' => 'South & City College Birmingham',
                'cities' => ['Birmingham'],
            ],
            [
                'school' => 'Southbourne School of English',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'St Giles International',
                'cities' => ['London Central'],
            ],
            [
                'school' => 'Stafford House',
                'cities' => ['London', 'Cambridge', 'Canterbury'],
            ],
            [
                'school' => 'The London School of English',
                'cities' => ['London'],
            ],
            [
                'school' => 'Twin English Centre',
                'cities' => ['London'],
            ],
            [
                'school' => 'UK College of English',
                'cities' => ['London'],
            ],
            [
                'school' => 'Westbourne Academy',
                'cities' => ['Bournemouth'],
            ],
            [
                'school' => 'Wimbledon School of English',
                'cities' => ['London'],
            ],
        ];

        $branches = [];

        foreach ($definitions as $def) {
            $schoolName = $def['school'];

            if (! isset($schoolIds[$schoolName])) {
                // School not found – skip all its branches
                continue;
            }

            $schoolId = $schoolIds[$schoolName];

            foreach ($def['cities'] as $cityName) {
                if (! isset($cityIds[$cityName])) {
                    // City not found – skip this branch
                    continue;
                }

                $cityId = $cityIds[$cityName];

                $branches[] = [
                    'school_id'      => $schoolId,
                    'city_id'        => $cityId,
                    'slug'           => Str::slug($schoolName.'-'.$cityName),
                    'description'    => "{$schoolName} branch in {$cityName} offers English language courses and local student support as part of the school’s international network.",
                    'ar_description' => "فرع {$schoolName} في مدينة {$cityName} يقدّم دورات في اللغة الإنجليزية وخدمات دعم محلية للطلاب كجزء من شبكة المعهد الدولية.",
                    'gallery_urls'   => null,
                    'video_url'      => null,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }
        }

        if (! empty($branches)) {
            DB::table('school_branches')->insert($branches);
        }
    }
}
