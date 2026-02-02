<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Support\Str;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create 5 Categories
        $categories = ['Ranking', 'Scholarships', 'Student Life', 'Visa', 'Destinations'];
        $catIds = [];
        foreach ($categories as $cat) {
            $created = BlogCategory::firstOrCreate(
                ['name' => $cat],
                ['slug' => Str::slug($cat)]
            );
            $catIds[] = $created->id;
        }

        // 2. Create 10 Tags
        $tags = ['Study Abroad', 'Funding', 'Tips', 'Guide', 'Interview', 'Germany', 'USA', 'UK', 'Canada', 'IELTS'];
        $tagIds = [];
        foreach ($tags as $tag) {
            $created = BlogTag::firstOrCreate(
                ['name' => $tag],
                ['slug' => Str::slug($tag)]
            );
            $tagIds[] = $created->id;
        }

        // 3. Get a publisher (first admin or create one)
        $publisher = User::first() ?? User::factory()->create();

        // 4. Create 10 Blogs
        $blogs = [
            [
                'title' => 'Top 10 Universities for Computer Science in 2025',
                'category_id' => $catIds[0], // Ranking
                'summary' => 'Discover the leading institutions shaping the future of technology. From MIT to Stanford.',
                'content' => 'Full content about universities...',
                'featured_image' => '/assets/blogs/cs_ranking.png',
            ],
            [
                'title' => 'How to Secure a Full Scholarship',
                'category_id' => $catIds[1], // Scholarships
                'summary' => 'Financial aid can be a game-changer. Learn the strategies to identify and apply.',
                'content' => 'Full content about scholarships...',
                'featured_image' => '/assets/blogs/scholarship.png',
            ],
            [
                'title' => 'Living in London: A Student\'s Guide',
                'category_id' => $catIds[2], // Student Life
                'summary' => 'From accommodation tips to finding the best cheap eats in London.',
                'content' => 'Full content about London...',
                'featured_image' => '/assets/blogs/london.png',
            ],
            [
                'title' => 'Visa Interview Questions You Must Prepare For',
                'category_id' => $catIds[3], // Visa
                'summary' => 'Common questions asked by visa officers and how to answer them confidently.',
                'content' => 'Full content about Visa interviews...',
                'featured_image' => '/assets/blogs/visa.png',
            ],
            [
                'title' => 'The Benefits of Studying in Germany',
                'category_id' => $catIds[4], // Destinations
                'summary' => 'Germany offers tuition-free education and excellent career prospects.',
                'content' => 'Full content about Germany...',
                'featured_image' => '/assets/blogs/germany.png',
            ],
            [
                'title' => 'IELTS vs TOEFL: Which One Should You Take?',
                'category_id' => $catIds[0], // Ranking/Test Prep
                'summary' => 'We break down the differences between IELTS and TOEFL to help you decide.',
                'content' => 'Full content about tests...',
                'featured_image' => '/assets/blogs/ielts.png',
            ],
            [
                'title' => '5 Tips for Writing a Winning SOP',
                'category_id' => $catIds[2], // Student Life/Application
                'summary' => 'Learn how to craft a compelling narrative that stands out.',
                'content' => 'Full content about SOP...',
                'featured_image' => '/assets/blogs/sop.png',
            ],
            [
                'title' => 'Post-Residency Work Rights in Canada',
                'category_id' => $catIds[4], // Destinations
                'summary' => 'Canada\'s PGWP allows you to work after graduation. Understand the rules.',
                'content' => 'Full content about Canada...',
                'featured_image' => '/assets/blogs/canada.png',
            ],
            [
                'title' => 'Understanding the US University System',
                'category_id' => $catIds[4], // Destinations
                'summary' => 'A comprehensive guide to how the US higher education system works.',
                'content' => 'Full content about US system...',
                'featured_image' => '/assets/blogs/usa.png',
            ],
            [
                'title' => 'Budgeting for Study Abroad',
                'category_id' => $catIds[2], // Student Life
                'summary' => 'How to manage your finances while studying in a foreign country.',
                'content' => 'Full content about budgeting...',
                'featured_image' => '/assets/blogs/budget.png',
            ],
        ];

        foreach ($blogs as $b) {
            $blog = Blog::updateOrCreate(
                ['slug' => Str::slug($b['title'])],
                [
                    'title' => $b['title'],
                    'ar_title' => 'AR ' . $b['title'],
                    'summary' => $b['summary'],
                    'ar_summary' => 'AR ' . $b['summary'],
                    'content' => $b['content'],
                    'ar_content' => 'AR content...',
                    'category_id' => $b['category_id'],
                    'audience_scope' => 'all',
                    'featured_image' => $b['featured_image'],
                    'published_at' => now(),
                    'publisher_id' => $publisher->id,
                ]
            );

            // Attach 2 random tags
            $randomTags = collect($tagIds)->random(2);
            $blog->tags()->attach($randomTags);
        }
    }
}
