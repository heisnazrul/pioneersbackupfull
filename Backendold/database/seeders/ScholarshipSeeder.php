<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Global Excellence Scholarship',
            'Future Leaders Award',
            'STEM Women Scholarship',
            'International Merit Award',
            'Commonwealth Scholarship',
            'Chevening Scholarship',
            'Fulbright Scholarship',
            'Erasmus Mundus',
            'Great Scholarship',
            'Vice-Chancellor Award'
        ];

        foreach ($titles as $title) {
            Scholarship::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'name' => $title,
                    'amount_type' => 'fixed',
                    'amount_value' => rand(5000, 20000),
                    'currency' => 'GBP',
                    'description' => 'A prestigious scholarship for high-achieving students.',
                    'eligibility_text' => 'Minimum GPA 3.5',
                    'deadline_date' => now()->addMonths(rand(1, 6)),
                    'is_active' => true,
                ]
            );
        }
    }
}
