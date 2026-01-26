<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UniversityCms;
use Illuminate\Http\Request;

class CmsApiController extends Controller
{
    public function destinations()
    {
        $cms = UniversityCms::where('section', 'destinations')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'destinations_heading' => 'Explore Top Destinations',
                'destinations_subtitle' => 'Global Opportunities',
                'destinations_button_text' => 'View All Countries →',
            ]);
        }

        return response()->json($cms->content);
    }

    public function reviews()
    {
        $cms = UniversityCms::where('section', 'reviews')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'reviews_heading' => 'What our students say about their journey with us',
            ]);
        }

        return response()->json($cms->content);
    }

    public function blogs()
    {
        $cms = UniversityCms::where('section', 'blogs')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'blogs_heading' => 'Blogs & Latest News',
                'blogs_button_text' => 'All articles',
            ]);
        }

        return response()->json($cms->content);
    }

    public function whyChoose()
    {
        $cms = UniversityCms::where('section', 'why_choose')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'why_choose_heading' => 'Why Students Trust Us',
                'why_choose_subtitle' => 'Our Value',
                'items' => [
                    [
                        'id' => 1,
                        'title' => '100% Free Service',
                        'description' => 'We do not charge students any fees for counseling or application processing.',
                        'icon' => 'gift'
                    ],
                    [
                        'id' => 2,
                        'title' => '100% Transparency',
                        'description' => 'No hidden costs or bias. We help you choose what is truly best for you.',
                        'icon' => 'eye'
                    ],
                    [
                        'id' => 3,
                        'title' => 'Expert Counselors',
                        'description' => 'Our team comprises alumni from top global universities.',
                        'icon' => 'user-check'
                    ],
                    [
                        'id' => 4,
                        'title' => '98% Visa Success',
                        'description' => 'Proven track record of success in difficult cases.',
                        'icon' => 'check-circle'
                    ],
                    [
                        'id' => 5,
                        'title' => 'End-to-End Support',
                        'description' => 'From counseling to pre-departure briefing.',
                        'icon' => 'globe'
                    ]
                ]
            ]);
        }

        // Format content to include items array if flattened keys exist
        $data = $cms->content;
        $items = [];
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($data["item_{$i}_title"])) {
                $items[] = [
                    'id' => $i,
                    'title' => $data["item_{$i}_title"] ?? '',
                    'description' => $data["item_{$i}_description"] ?? '',
                    'icon' => $data["item_{$i}_icon"] ?? 'check-circle',
                ];
            }
        }

        if (!empty($items)) {
            $data['items'] = $items;
        }

        return response()->json($data);
    }

    public function certificates()
    {
        $cms = UniversityCms::where('section', 'certificates')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'certificates_heading' => 'We are accredited by many institutions',
                'certificates_subtitle' => 'We are proud of our partnerships with leading English language institutes and accredited educational organizations around the world.',
            ]);
        }

        return response()->json($cms->content);
    }

    public function stats()
    {
        $cms = UniversityCms::where('section', 'stats')->first();

        if (!$cms || empty($cms->content)) {
            return response()->json([
                'stats_heading' => 'Our achievements in numbers',
                'stats_description' => 'Thanks to our trusted partners and leading educational institutions around the world, we’ve helped thousands of students achieve their dream of learning English in accredited international environments.',
                'stat_1_value' => '+15,000',
                'stat_1_label' => 'Students enrolled in accredited English programs abroad',
                'stat_2_value' => '+50',
                'stat_2_label' => 'Partner universities offering accredited English study programs abroad',
            ]);
        }

        return response()->json($cms->content);
    }

    public function hero()
    {
        $cms = UniversityCms::where('section', 'hero')->first();

        if (!$cms || empty($cms->content)) {
            // Return default structure if empty, matching frontend expectations
            return response()->json([
                'hero_title' => 'Shape Your Future with World-Class Education',
                'hero_subtitle' => 'Expert guidance and personalized support to help you secure admission at the world\'s leading universities.',
                'hero_bg' => null,
                'hero_figure' => null,
                'hero_tab_1_text' => 'Find Courses',
                'hero_tab_2_text' => 'Find Universities',
                'hero_button_text' => 'Search',
                'hero_search_courses_label' => 'SEARCH COURSES',
                'hero_search_universities_label' => 'SEARCH UNIVERSITIES',
                'hero_search_courses_placeholder' => 'e.g. Computer Science, MBA...',
                'hero_search_universities_placeholder' => 'e.g. Oxford, Harvard...',
                'hero_country_label' => 'COUNTRY',
                'hero_country_placeholder' => 'All Countries',
                'hero_study_level_label' => 'STUDY LEVEL',
                'hero_study_level_placeholder' => 'Select...',
                'hero_intake_label' => 'INTAKE',
                'hero_intake_placeholder' => 'Any Intake',
            ]);
        }

        // Return the content directly as it's already structured JSON
        return response()->json($cms->content);
    }
    public function universities()
    {
        // This section uses the Setting model (legacy/placeholder storage)
        // unlike other sections that use UniversityCms model.
        $content = \App\Models\Setting::get('cms_university_universities', []);

        if (empty($content)) {
            return response()->json([
                'universities_heading' => 'Prestigious Universities',
                'universities_subtitle' => 'World Class Rankings',
                'universities_button_text' => 'Browse Universities →',
                'universities_button_link' => '/search',
            ]);
        }

        return response()->json($content);
    }

    public function videoReviews()
    {
        $content = \App\Models\Setting::get('cms_university_video_reviews', []);

        if (empty($content)) {
            return response()->json([
                'video_reviews_heading' => 'Hear from our students',
                'video_reviews_subtitle' => 'Student Stories',
                'video_reviews_button_text' => 'View All',
                'video_reviews_button_link' => '/reviews',
            ]);
        }

        return response()->json($content);
    }
}
