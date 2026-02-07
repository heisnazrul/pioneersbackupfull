<?php

namespace Database\Seeders;

use App\Models\FeaturedList;
use App\Models\IntakeTerm;
use App\Models\LanguageTest;
use App\Models\Level;
use App\Models\SubjectArea;
use App\Models\UniversityCourseTag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseAttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Study Levels
        $levels = [
            ['name' => 'Pre-Sessional English', 'sort_order' => 10],
            ['name' => 'Foundation', 'sort_order' => 20],
            ['name' => 'Undergraduate', 'sort_order' => 30],
            ['name' => 'Postgraduate', 'sort_order' => 40],
            ['name' => 'PhD / Doctorate', 'sort_order' => 50],
            ['name' => 'Vocational / Diploma', 'sort_order' => 60],
        ];

        foreach ($levels as $level) {
            Level::updateOrCreate(
                ['key' => Str::slug($level['name'])],
                [
                    'name' => $level['name'],
                    'sort_order' => $level['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 2. Subject Areas
        $subjects = [
            ['name' => 'Business & Management', 'sort_order' => 10],
            ['name' => 'Computer Science & IT', 'sort_order' => 20],
            ['name' => 'Engineering', 'sort_order' => 30],
            ['name' => 'Medicine & Health', 'sort_order' => 40],
            ['name' => 'Arts, Design & Architecture', 'sort_order' => 50],
            ['name' => 'Social Sciences', 'sort_order' => 60],
            ['name' => 'Law', 'sort_order' => 70],
            ['name' => 'Natural Sciences', 'sort_order' => 80],
        ];

        foreach ($subjects as $subject) {
            SubjectArea::updateOrCreate(
                ['key' => Str::slug($subject['name'])],
                [
                    'name' => $subject['name'],
                    'slug' => Str::slug($subject['name']),
                    'sort_order' => $subject['sort_order'],
                    'is_active' => true,
                ]
            );
        }

        // 3. Intake Terms (Major intakes)
        $intakes = [
            ['name' => 'January 2025', 'month_num' => 1],
            ['name' => 'May 2025', 'month_num' => 5],
            ['name' => 'September 2025', 'month_num' => 9],
            ['name' => 'January 2026', 'month_num' => 1],
            ['name' => 'September 2026', 'month_num' => 9],
        ];

        foreach ($intakes as $index => $intake) {
            IntakeTerm::updateOrCreate(
                ['key' => Str::slug($intake['name'])],
                [
                    'name' => $intake['name'],
                    'month_num' => $intake['month_num'],
                    'sort_order' => ($index + 1) * 10,
                    'is_active' => true,
                ]
            );
        }

        // 4. Language Tests
        $tests = [
            'IELTS Academic',
            'TOEFL iBT',
            'PTE Academic',
            'Duolingo English Test',
            'Cambridge Enlgish (C1/C2)',
        ];

        foreach ($tests as $test) {
            LanguageTest::updateOrCreate(
                ['key' => Str::slug($test)],
                ['name' => $test, 'is_active' => true]
            );
        }

        // 5. Course Tags
        $tags = [
            'Scholarship Available',
            'Internship Included',
            'Placements Available',
            'Top Ranked',
            'Fast Track',
            'Online Available',
        ];

        foreach ($tags as $tag) {
            UniversityCourseTag::updateOrCreate(
                ['key' => Str::slug($tag)],
                ['name' => $tag, 'is_active' => true]
            );
        }

        // 6. Featured Lists
        $lists = [
            'Top UK Universities',
            'Best Value Colleges',
            'Russell Group Universities',
            'STEM Programs',
            'Top Business Schools',
        ];

        foreach ($lists as $list) {
            FeaturedList::updateOrCreate(
                ['key' => Str::slug($list, '_')], // snake_case for list keys usually
                ['name' => $list, 'is_active' => true]
            );
        }
    }
}
