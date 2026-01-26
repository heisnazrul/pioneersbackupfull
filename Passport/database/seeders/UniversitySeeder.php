<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\UniversityCourse;
use App\Models\Country;
use App\Models\City;
use App\Models\UniversityCourseLevel;
use Illuminate\Support\Str;

class UniversitySeeder extends Seeder
{
    public function run()
    {
        // Ensure Course Levels Exist
        $levels = ['Bachelor', 'Master', 'PhD'];
        foreach ($levels as $level) {
            UniversityCourseLevel::firstOrCreate(
                ['slug' => Str::slug($level)],
                ['name' => $level]
            );
        }

        $countriesData = [
            'United Kingdom' => [
                'universities' => [
                    [
                        'name' => 'University of Oxford',
                        'city' => 'Oxford',
                        'website' => 'https://www.ox.ac.uk',
                        'courses' => ['Computer Science', 'Medicine', 'Law', 'History', 'Physics']
                    ],
                    [
                        'name' => 'University of Cambridge',
                        'city' => 'Cambridge',
                        'website' => 'https://www.cam.ac.uk',
                        'courses' => ['Engineering', 'Mathematics', 'Economics', 'Biological Sciences', 'Psychology']
                    ]
                ]
            ],
            'United States' => [
                'universities' => [
                    [
                        'name' => 'Harvard University',
                        'city' => 'Cambridge',
                        'website' => 'https://www.harvard.edu',
                        'courses' => ['Computer Science', 'Business Administration', 'Law', 'Public Policy', 'Medicine']
                    ],
                    [
                        'name' => 'Massachusetts Institute of Technology',
                        'city' => 'Cambridge',
                        'website' => 'https://www.mit.edu',
                        'courses' => ['Electrical Engineering', 'Mechanical Engineering', 'Physics', 'Chemistry', 'Biology']
                    ]
                ]
            ],
            'Canada' => [
                'universities' => [
                    [
                        'name' => 'University of Toronto',
                        'city' => 'Toronto',
                        'website' => 'https://www.utoronto.ca',
                        'courses' => ['Computer Science', 'Engineering', 'Humanities', 'Social Sciences', 'Life Sciences']
                    ],
                    [
                        'name' => 'McGill University',
                        'city' => 'Montreal',
                        'website' => 'https://www.mcgill.ca',
                        'courses' => ['Medicine', 'Law', 'Engineering', 'Management', 'Arts']
                    ]
                ]
            ],
            'Australia' => [
                'universities' => [
                    [
                        'name' => 'The University of Melbourne',
                        'city' => 'Melbourne',
                        'website' => 'https://www.unimelb.edu.au',
                        'courses' => ['Arts', 'Biomedicine', 'Commerce', 'Design', 'Science']
                    ],
                    [
                        'name' => 'The University of Sydney',
                        'city' => 'Sydney',
                        'website' => 'https://www.sydney.edu.au',
                        'courses' => ['Business', 'Engineering', 'Medicine and Health', 'Architecture', 'Law']
                    ]
                ]
            ],
            'Hungary' => [
                'universities' => [
                    [
                        'name' => 'University of Debrecen',
                        'city' => 'Debrecen',
                        'website' => 'https://unideb.hu',
                        'courses' => ['Medicine', 'Engineering', 'Informatics', 'Science', 'Economics']
                    ],
                    [
                        'name' => 'University of Szeged',
                        'city' => 'Szeged',
                        'website' => 'https://u-szeged.hu',
                        'courses' => ['Medicine', 'Pharmacy', 'Science', 'Law', 'Humanities']
                    ]
                ]
            ],
            'Cyprus' => [
                'universities' => [
                    [
                        'name' => 'University of Nicosia',
                        'city' => 'Nicosia',
                        'website' => 'https://www.unic.ac.cy',
                        'courses' => ['Medicine', 'Business', 'Education', 'Law', 'Computer Science']
                    ],
                    [
                        'name' => 'European University Cyprus',
                        'city' => 'Nicosia',
                        'website' => 'https://euc.ac.cy',
                        'courses' => ['Medicine', 'Dentistry', 'Business', 'Law', 'Computer Engineering']
                    ]
                ]
            ],
            'New Zealand' => [
                'universities' => [
                    [
                        'name' => 'The University of Auckland',
                        'city' => 'Auckland',
                        'website' => 'https://www.auckland.ac.nz',
                        'courses' => ['Arts', 'Business', 'Creative Arts and Industries', 'Education and Social Work', 'Engineering']
                    ],
                    [
                        'name' => 'University of Otago',
                        'city' => 'Dunedin',
                        'website' => 'https://www.otago.ac.nz',
                        'courses' => ['Health Sciences', 'Humanities', 'Sciences', 'Commerce', 'Dentistry']
                    ]
                ]
            ],
            'Germany' => [
                'universities' => [
                    [
                        'name' => 'Technical University of Munich',
                        'city' => 'Munich',
                        'website' => 'https://www.tum.de',
                        'courses' => ['Engineering', 'Natural Sciences', 'Medicine', 'Management', 'Political Science']
                    ],
                    [
                        'name' => 'Humboldt University of Berlin',
                        'city' => 'Berlin',
                        'website' => 'https://www.hu-berlin.de',
                        'courses' => ['Arts and Humanities', 'Law', 'Life Sciences', 'Mathematics', 'Social Sciences']
                    ]
                ]
            ]
        ];

        foreach ($countriesData as $countryName => $data) {
            $country = Country::firstOrCreate(
                ['name' => $countryName],
                [
                    'slug' => Str::slug($countryName),
                    'ar_name' => $countryName, // Fallback
                    'flag' => 'flag.png', // Dummy flag
                    'currency_code' => 'USD', // Fallback
                    'continent' => 'Europe', // Fallback
                    'is_active' => true,
                    'is_popular' => true,
                    'country_code' => strtoupper(substr($countryName, 0, 2)), // Fallback
                    'phone_code' => '00' // Fallback
                ]
            );

            foreach ($data['universities'] as $uniData) {
                $city = City::firstOrCreate(
                    ['name' => $uniData['city'], 'country_id' => $country->id],
                    [
                        'slug' => Str::slug($uniData['city']),
                        'ar_name' => $uniData['city'], // Fallback
                        'is_active' => true
                    ]
                );

                $university = University::updateOrCreate(
                    ['slug' => Str::slug($uniData['name'])],
                    [
                        'name' => $uniData['name'],
                        'country_id' => $country->id,
                        'city_id' => $city->id,
                        'website' => $uniData['website'],
                        'type' => 'public',
                        'is_active' => true,
                        'is_featured' => true,
                        'established_year' => rand(1901, 1990),
                        'logo' => null, // Would typically be a path
                        'cover_image' => null
                    ]
                );

                // Create Detail
                $university->details()->updateOrCreate(
                    ['university_id' => $university->id],
                    [
                        'description' => "This is a dummy description for {$university->name}. It is a prestigious institution located in {$city->name}, {$country->name}.",
                        'history' => 'Founded specifically for testing purposes.',
                        'address' => "123 University Ave, {$city->name}"
                    ]
                );

                // Create Campus
                $mainCampus = \App\Models\UniversityCampus::updateOrCreate(
                    [
                        'slug' => Str::slug($uniData['name'] . '-main-campus'),
                        'university_id' => $university->id
                    ],
                    [
                        'city_id' => $city->id,
                        'name' => 'Main Campus',
                        'address' => "123 University Ave, {$city->name} (Main Campus)",
                        'map_coordinates' => null
                    ]
                );

                $northCampus = \App\Models\UniversityCampus::updateOrCreate(
                    [
                        'slug' => Str::slug($uniData['name'] . '-north-campus'),
                        'university_id' => $university->id
                    ],
                    [
                        'city_id' => $city->id,
                        'name' => 'North Campus',
                        'address' => "456 North St, {$city->name} (North Campus)",
                        'map_coordinates' => null
                    ]
                );

                $campuses = [$mainCampus, $northCampus];

                // Create Courses
                foreach ($uniData['courses'] as $courseName) {
                    $level = UniversityCourseLevel::inRandomOrder()->first();
                    $assignedCampus = $campuses[array_rand($campuses)];

                    $course = UniversityCourse::updateOrCreate(
                        [
                            'university_id' => $university->id,
                            'slug' => Str::slug($university->slug . '-' . $courseName . '-' . $level->slug)
                        ],
                        [
                            'campus_id' => $assignedCampus->id,
                            'name' => $courseName,
                            'level_id' => $level->id,
                            'faculty_name' => 'Main Faculty',
                            'duration_months' => rand(12, 48),
                            'tuition_fee' => rand(5000, 50000),
                            'currency' => 'USD',
                        ]
                    );

                    // Create Course Details
                    $course->details()->updateOrCreate(
                        ['course_id' => $course->id],
                        [
                            'overview' => "A comprehensive {$level->name} course in {$courseName} at {$assignedCampus->name}.",
                            'curriculum' => 'Year 1: Basics, Year 2: Advanced, Year 3: Project',
                            'career_opportunities' => 'High demand in global market.'
                        ]
                    );
                }
            }
        }
    }
}
