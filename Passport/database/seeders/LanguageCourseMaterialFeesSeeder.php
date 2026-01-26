<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LanguageCourse;
use App\Models\LanguageCourseMaterialFee;

class LanguageCourseMaterialFeesSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * Notes:
         * - 'course' = null → apply to ALL courses in that branch.
         * - 'billing_unit' is either 'course' or 'week'.
         * - billing_count is always 1.
         * - Rows with empty material fee are omitted.
         * - Strings must match language_courses via school/city/branch names.
         */

        $rows = [
            ['school' => 'Anglotec Academy', 'city' => 'Scarborough', 'course' => 'General English', 'amount' => 100, 'billing_unit' => 'course'],
            ['school' => 'Atlantic Centre of Education', 'city' => 'Galway', 'course' => null, 'amount' => 55, 'billing_unit' => 'course'],

            ['school' => 'Bayswater', 'city' => 'London',     'course' => null, 'amount' => 7,  'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Liverpool',  'course' => null, 'amount' => 7,  'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Brighton',   'course' => null, 'amount' => 7,  'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Bournemouth','course' => null, 'amount' => 7,  'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Vancouver',  'course' => null, 'amount' => 10, 'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Toronto',    'course' => null, 'amount' => 10, 'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Calgary',    'course' => null, 'amount' => 10, 'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Cape Town',  'course' => null, 'amount' => 7,  'billing_unit' => 'week'],
            ['school' => 'Bayswater', 'city' => 'Cyprus (Limassol)', 'course' => null, 'amount' => 7, 'billing_unit' => 'week'],

            ['school' => 'Berlitz', 'city' => 'London',     'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'Berlitz', 'city' => 'Manchester', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'Berlitz', 'city' => 'Dublin',     'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'Bright School of English', 'city' => 'Bournemouth', 'course' => null, 'amount' => 30, 'billing_unit' => 'course'],
            ['school' => 'Bournemouth City College BCC', 'city' => 'Bournemouth', 'course' => null, 'amount' => 60, 'billing_unit' => 'course'],
            ['school' => 'Brighton Language College International', 'city' => 'Brighton', 'course' => null, 'amount' => 35, 'billing_unit' => 'course'],

            ['school' => 'Burlington School', 'city' => 'London', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'General English',         'amount' => 28, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'Intensive English',       'amount' => 28, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'IELTS Exam Preparation',  'amount' => 45, 'billing_unit' => 'course'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Cork', 'course' => 'General English',        'amount' => 28, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Cork', 'course' => 'IELTS Exam Preparation', 'amount' => 45, 'billing_unit' => 'course'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Toronto',  'course' => null, 'amount' => 20, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Vancouver','course' => null, 'amount' => 20, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'London',   'course' => null, 'amount' => 32, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Edinburgh','course' => null, 'amount' => 32, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Oxford',   'course' => null, 'amount' => 32, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Leeds',    'course' => null, 'amount' => 32, 'billing_unit' => 'course'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Worthing', 'course' => null, 'amount' => 32, 'billing_unit' => 'course'],

            ['school' => 'Eurospeak Language School', 'city' => 'Southampton', 'course' => 'General English', 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'Eurospeak Language School', 'city' => 'Reading',     'course' => 'General English', 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'International House', 'city' => 'London',  'course' => null, 'amount' => 25, 'billing_unit' => 'course'],
            ['school' => 'International House', 'city' => 'Bristol', 'course' => null, 'amount' => 48, 'billing_unit' => 'course'],

            ['school' => 'Imagine English Liverpool Academy', 'city' => 'Liverpool', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'International Language Centres', 'city' => 'Birmingham', 'course' => null, 'amount' => 50, 'billing_unit' => 'course'],
            ['school' => 'International Language Centres', 'city' => 'Bristol',    'course' => null, 'amount' => 50, 'billing_unit' => 'course'],
            ['school' => 'International Language Centres', 'city' => 'Cambridge',  'course' => null, 'amount' => 50, 'billing_unit' => 'course'],
            ['school' => 'International Language Centres', 'city' => 'Colchester', 'course' => null, 'amount' => 50, 'billing_unit' => 'course'],
            ['school' => 'International Language Centres', 'city' => 'Portsmouth', 'course' => null, 'amount' => 50, 'billing_unit' => 'course'],

            ['school' => 'Kensington Academy of English', 'city' => 'London', 'course' => null, 'amount' => 35, 'billing_unit' => 'course'],

            ['school' => 'LILA* College', 'city' => 'Liverpool', 'course' => null, 'amount' => 45, 'billing_unit' => 'course'],

            ['school' => 'MC Academy', 'city' => 'Liverpool',  'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'MC Academy', 'city' => 'Manchester', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'Nacel English School', 'city' => 'London', 'course' => null, 'amount' => 38, 'billing_unit' => 'course'],

            ['school' => 'Oxford International English Schools OIES', 'city' => 'Brighton', 'course' => null, 'amount' => 75, 'billing_unit' => 'course'],

            ['school' => 'Oxford International Study Centre', 'city' => 'Oxford', 'course' => null, 'amount' => 30, 'billing_unit' => 'course'],

            ['school' => 'Preston Academy of English', 'city' => 'Preston', 'course' => null, 'amount' => 35, 'billing_unit' => 'course'],

            ['school' => 'St Giles International', 'city' => 'Brighton',        'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'St Giles International', 'city' => 'Eastbourne',      'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'St Giles International', 'city' => 'London Central',  'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'St Giles International', 'city' => 'London Highgate', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],
            ['school' => 'St Giles International', 'city' => 'Cambridge',       'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'Wimbledon School of English', 'city' => 'London', 'course' => null, 'amount' => 110, 'billing_unit' => 'course'],

            ['school' => 'UK College of English', 'city' => 'London', 'course' => null, 'amount' => 40, 'billing_unit' => 'course'],

            ['school' => 'LSI Education', 'city' => 'London',   'course' => null, 'amount' => 9,  'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Brighton', 'course' => null, 'amount' => 9,  'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Cambridge','course' => null, 'amount' => 9,  'billing_unit' => 'week'],

            ['school' => 'LSI Education', 'city' => 'New York',  'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Boston',    'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Berkeley',  'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'San Diego', 'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Vancouver', 'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Toronto',   'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Auckland',  'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
            ['school' => 'LSI Education', 'city' => 'Brisbane',  'course' => null, 'amount' => 15, 'billing_unit' => 'week'],

            ['school' => 'LSI Education', 'city' => 'Paris',   'course' => null, 'amount' => 30, 'billing_unit' => 'course'],
            ['school' => 'LSI Education', 'city' => 'Zurich',  'course' => null, 'amount' => 15, 'billing_unit' => 'week'],
        ];

        foreach ($rows as $row) {
            $courses = LanguageCourse::query()
                ->when($row['course'], fn ($q) => $q->where('name', $row['course']))
                ->whereHas('branch', function ($q) use ($row) {
                    $q->whereHas('school', fn ($qq) => $qq->where('name', $row['school']))
                      ->whereHas('city', fn ($qq) => $qq->where('name', $row['city']));
                })
                ->get();

            foreach ($courses as $course) {
                LanguageCourseMaterialFee::updateOrCreate(
                    ['language_course_id' => $course->id],
                    [
                        'amount'        => $row['amount'],
                        'billing_unit'  => $row['billing_unit'],
                        'billing_count' => 1,
                    ]
                );
            }
        }
    }
}
