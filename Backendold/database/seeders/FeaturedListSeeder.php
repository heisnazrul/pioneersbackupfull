<?php

namespace Database\Seeders;

use App\Models\FeaturedList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeaturedListSeeder extends Seeder
{
    public function run(): void
    {
        $lists = [
            'Top UK Universities',
            'Affordable MBA Programs',
            'Universities with No IELTS',
            'Best for Computer Science',
            'Top Medical SChools',
            'Engineering Excellence',
            'Arts and Design Hubs',
            'Research Intensive Universities',
            'Russell Group Members',
            'Modern Universities'
        ];

        foreach ($lists as $title) {
            FeaturedList::updateOrCreate(
                ['key' => Str::slug($title)],
                [
                    'name' => $title, // Migration uses 'name', not 'title'? let's check view_file 4233. Yes, 'name'.
                    'is_active' => true,
                ]
            );
        }
    }
}
