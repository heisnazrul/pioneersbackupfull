<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['John Doe', 'Sarah Smith', 'Ali Khan', 'Maria Garcia', 'Chen Wei', 'Ahmed Hassan', 'Emily Johnson', 'David Lee', 'Fatima Al-Sayed', 'James Wilson'];

        // Seed Standard Reviews
        foreach ($names as $name) {
            Review::firstOrCreate(
                ['name' => $name],
                [
                    'institute_name' => 'University of London',
                    'title' => 'Highly Recommended',
                    'review_text' => 'An amazing experience! The support was fantastic and I love the campus.',
                    'rating' => rand(4, 5),
                    'is_approved' => true,
                ]
            );
        }

        // Seed Video Reviews
        $videoReviewers = ['Michael Brown', 'Linda Green', 'Robert Taylor'];
        foreach ($videoReviewers as $name) {
            Review::firstOrCreate(
                ['name' => $name],
                [
                    'institute_name' => 'University of Manchester',
                    'title' => 'My Journey',
                    'review_text' => 'Watch my full review of the course.',
                    'rating' => 5,
                    'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'thumbnail' => null, // or a placeholder path
                    'is_approved' => true,
                    'university_name' => 'University of Manchester', // Explicitly setting for API compatibility
                    'course_name' => 'MBA',
                    'country_name' => 'UK',
                ]
            );
        }
    }
}
