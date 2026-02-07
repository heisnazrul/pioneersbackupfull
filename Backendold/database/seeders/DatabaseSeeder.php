<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            UniversitySeeder::class,
            DestinationSeeder::class,
            CourseAttributesSeeder::class,
            FaqSeeder::class,
            BlogSeeder::class,
            ScholarshipSeeder::class,
            ReviewSeeder::class,
            CertificationSeeder::class,
            FeaturedListSeeder::class,
            UniversityCampusSeeder::class,
            UniversityCourseSeeder::class,
        ]);
    }
}
