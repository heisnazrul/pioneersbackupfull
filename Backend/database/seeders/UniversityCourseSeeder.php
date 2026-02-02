<?php

namespace Database\Seeders;

use App\Models\UniversityCourse;
use App\Models\University;
use App\Models\Level;
use App\Models\SubjectArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UniversityCourseSeeder extends Seeder
{
    public function run(): void
    {
        $uni = University::first();
        $level = Level::first() ?? Level::create(['name' => 'Postgraduate', 'slug' => 'postgraduate']);
        $subject = SubjectArea::first() ?? SubjectArea::create(['name' => 'Computer Science', 'slug' => 'computer-science']);

        if (!$uni)
            return;

        $courses = [
            'MSc Data Science',
            'MBA Global Business',
            'BSc Computer Science',
            'MA Digital Media',
            'LLM International Law',
            'MSc Artificial Intelligence',
            'BEng Civil Engineering',
            'MSc Cyber Security',
            'BA Graphic Design',
            'MPharma Pharmacy'
        ];

        foreach ($courses as $title) {
            UniversityCourse::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'university_id' => $uni->id,
                    'name' => $title,
                    'level_id' => $level->id,
                    'subject_area_id' => $subject->id,
                    'duration_value' => 12,
                    'duration_unit' => 'month',
                    'first_year_fee' => 15000,
                    'currency' => 'GBP',
                    'is_active' => true,
                ]
            );
        }
    }
}
