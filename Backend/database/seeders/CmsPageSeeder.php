<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CmsPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // About Us Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Pioneers',
                'sub_title' => 'Transforming lives through international education since 2012.',
                'meta_title' => 'About Us | Pioneers Admissions',
                'meta_description' => 'Welcome to Pioneers Educational Admission Consultancy. We guide students to prestigious institutions worldwide.',
                'content' => [
                    'hero' => [
                        'badge' => 'Who We Are',
                        'title' => 'About Pioneers',
                        'description' => 'Transforming lives through international education since 2012.'
                    ],
                    'director_message' => [
                        'image' => 'https://placehold.co/600x800?text=Director',
                        'name' => 'Md Abdul Qaium',
                        'role' => 'Director',
                        'title' => 'Welcome to Pioneers EDU',
                        'paragraphs' => [
                            'Dear Valued Partners, Students, and Stakeholders,',
                            'Welcome to Pioneers Educational Admission Consultancy (PEAC). From humble beginnings, we have grown into a global organization dedicated to transforming lives through international education. With offices across multiple countries, we guide students to prestigious institutions worldwide, ensuring their success and satisfaction.',
                            'Our team of highly experienced representatives, educated at renowned universities, provides expert, culturally sensitive guidance. This unique blend of expertise and empathy sets us apart.',
                            'We are proud of our high visa success rates and the trust placed in us by students and partners. Our commitment to innovation and personalized support continues to drive our growth and impact.'
                        ],
                        'closing' => [
                            'text' => 'Warm regards,',
                            'name' => 'Md Abdul Qaium',
                            'position' => 'Director, Pioneers Educational Admission Consultancy Ltd'
                        ]
                    ],
                    'ceo_message' => [
                        'image' => 'https://placehold.co/600x800?text=CEO',
                        'name' => 'Hanan Asiri',
                        'role' => 'CEO',
                        'title' => 'A Message from the CEO',
                        'paragraphs' => [
                            'Dear Students, Parents, and Collaborators,',
                            'As CEO of Pioneers Edu, I am honored to oversee an organization that prioritizes educational excellence and student success. Our mission is to empower students by providing access to world-class education and resources that shape their futures.',
                            'At Pioneers EDU, we believe in creating opportunities through innovation, collaboration, and integrity. With our global reach and experienced team, we have successfully guided thousands of students toward achieving their academic dreams.',
                            'Thank you for trusting us to be part of your journey. Together, we will continue to break barriers and build brighter futures for generations to come.'
                        ],
                        'closing' => [
                            'text' => 'Warm regards,',
                            'name' => 'Hanan Asiri',
                            'position' => 'CEO, Pioneers Educational Admission Consultancy Ltd'
                        ]
                    ],
                    'team' => [
                        'badge' => 'Our Experts',
                        'title' => 'Meet Our Team',
                        'members' => [
                            [
                                'name' => "Tasnim Zarin",
                                'role' => "Admission Consultation Leader",
                                'desc' => "Guiding and managing admissions to ensure a smooth enrollment process.",
                                'image' => "https://placehold.co/400x500?text=Tasnim"
                            ],
                            [
                                'name' => "Umme Habiba",
                                'role' => "Sales Manager",
                                'desc' => "Driving sales growth and leading teams to achieve business targets.",
                                'image' => "https://placehold.co/400x500?text=Umme"
                            ],
                            [
                                'name' => "Nazrul Islam",
                                'role' => "System Administrator",
                                'desc' => "Managing and securing IT systems to ensure seamless operations.",
                                'image' => "https://placehold.co/400x500?text=Nazrul"
                            ],
                            [
                                'name' => "Shohidul Hasan Mitu",
                                'role' => "BD Office Manager",
                                'desc' => "Overseeing operations and ensuring efficiency in BD office management.",
                                'image' => "https://placehold.co/400x500?text=Shohidul"
                            ]
                        ]
                    ]
                ]
            ]
        );

        // Contact Us Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact Us',
                'sub_title' => 'Get in touch with our team.',
                'meta_title' => 'Contact Us | Pioneers Admissions',
                'meta_description' => 'Get in touch with our team. Visit our offices in London, Dubai, Delhi, and New York.',
                'content' => [
                    'hero' => [
                        'badge' => "We're Here for You",
                        'title' => 'Contact Us',
                        'description' => "Whether you have a question about universities, visas, or just want to say hello, we're ready to answer all your questions."
                    ],
                    'contact_info' => [
                        'email' => 'info@pioneers.edu.sa',
                        'phone' => '+966 50 123 4567',
                        'description' => "Can't make it to an office? No problem. Fill out the form or reach out to us directly through our general channels.",
                        'social_links' => [
                            ['platform' => 'Facebook', 'url' => '#'],
                            ['platform' => 'Twitter', 'url' => '#'],
                            ['platform' => 'Instagram', 'url' => '#'],
                            ['platform' => 'LinkedIn', 'url' => '#']
                        ]
                    ],
                    'offices' => [
                        [
                            'id' => 1,
                            'city' => 'London',
                            'country' => 'UK',
                            'address' => '123 Oxford Street, London, W1D 1LP',
                            'phone' => '+44 20 7123 4567',
                            'email' => 'london@pioneers.edu',
                            'type' => 'Headquarters',
                            'slug' => 'london-office',
                            'image' => ''
                        ],
                        [
                            'id' => 2,
                            'city' => 'Dubai',
                            'country' => 'UAE',
                            'address' => 'Office 101, Business Bay, Dubai',
                            'phone' => '+971 4 123 4567',
                            'email' => 'dubai@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'dubai-office',
                            'image' => ''
                        ],
                        [
                            'id' => 3,
                            'city' => 'New Delhi',
                            'country' => 'India',
                            'address' => 'Connaught Place, New Delhi',
                            'phone' => '+91 11 1234 5678',
                            'email' => 'delhi@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'delhi-office',
                            'image' => ''
                        ],
                        [
                            'id' => 4,
                            'city' => 'New York',
                            'country' => 'USA',
                            'address' => '5th Avenue, New York, NY',
                            'phone' => '+1 212 123 4567',
                            'email' => 'ny@pioneers.edu',
                            'type' => 'Branch',
                            'slug' => 'ny-office',
                            'image' => ''
                        ]
                    ]
                ]
            ]
        );

        // Student Guide Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'student-guide'],
            [
                'title' => 'Student Guide',
                'sub_title' => 'Essential Student Guides',
                'meta_title' => 'Student Guide | Pioneers Admissions',
                'meta_description' => 'Expert advice and comprehensive resources for your international education journey.',
                'content' => [
                    'hero' => [
                        'badge' => 'Knowledge Hub',
                        'title' => 'Essential Student Guides',
                        'description' => 'Expert advice, insider tips, and comprehensive resources to help you thrive in your international education journey.'
                    ],
                    'categories' => [
                        [
                            'title' => "Pre-Departure",
                            'description' => "Packing lists, flight tips, and essential checklists before you leave home.",
                            'icon' => "faPlane",
                            'color' => "bg-blue-50 text-blue-600"
                        ],
                        [
                            'title' => "Academic Success",
                            'description' => "Study tips, understanding grading systems, and how to ace your assignments.",
                            'icon' => "faGraduationCap",
                            'color' => "bg-green-50 text-green-600"
                        ],
                        [
                            'title' => "Cost of Living",
                            'description' => "Budgeting advice, part-time work rules, and banking guides for students.",
                            'icon' => "faMoneyBillWave",
                            'color' => "bg-orange-50 text-orange-600"
                        ],
                        [
                            'title' => "City Guides",
                            'description' => "Deep dives into student life in London, New York, Toronto, and more.",
                            'icon' => "faCity",
                            'color' => "bg-purple-50 text-purple-600"
                        ]
                    ],
                    'trust_section' => [
                        'title' => 'Trusted by 10,000+ Students',
                        'description' => 'Our guides are written by experienced education counselors and alumni who have been through the process themselves. We ensure every piece of advice is accurate, up-to-date, and actionable.',
                        'cta_text' => 'Speak to an Expert',
                        'cta_link' => '/contact'
                    ]
                ]
            ]
        );

        // Visa Support Page Seeder
        \App\Models\CmsPage::updateOrCreate(
            ['slug' => 'visa-support'],
            [
                'title' => 'Visa Support',
                'sub_title' => 'Secure Your Student Visa',
                'meta_title' => 'Visa Support | Pioneers Admissions',
                'meta_description' => 'Expert guidance for UK, USA, Canada, and Australia student visas.',
                'content' => [
                    'hero' => [
                        'badge' => 'Visa Support Services',
                        'title' => 'Secure Your Student Visa',
                        'description' => 'Expert guidance for UK, USA, Canada, and Australia student visas. We minimize the risk of rejection with our proven methodology.'
                    ],
                    'services_section' => [
                        'title' => 'Comprehensive Visa Support',
                        'subtitle' => 'Detailed Assistance',
                        'description' => 'From document checklist to interview preparation, we cover every aspect of your application.',
                        'items' => [
                            [
                                'title' => "Document Verification",
                                'description' => "Reviewing your financial proofs, academic records, and sponsorship letters to meet embassy standards.",
                                'icon' => "faCheckDouble"
                            ],
                            [
                                'title' => "Mock Interviews",
                                'description' => "One-on-one sessions simulating real visa interviews to boost your confidence and readiness.",
                                'icon' => "faUserTie"
                            ],
                            [
                                'title' => "Application Strategy",
                                'description' => "Structuring your application to highlight your strong ties to your home country and genuine intent to study.",
                                'icon' => "faScaleBalanced"
                            ],
                            [
                                'title' => "Financial Guidance",
                                'description' => "Expert advice on presenting funds, sponsorships, and scholarships correctly.",
                                'icon' => "faFileShield"
                            ],
                            [
                                'title' => "Slot Booking",
                                'description' => "Assistance with booking biometric and interview slots at the earliest availability.",
                                'icon' => "faTimeline"
                            ],
                            [
                                'title' => "Post-Visa Support",
                                'description' => "Pre-departure briefings and guidance on travel insurance and accommodation.",
                                'icon' => "faPlaneDeparture"
                            ]
                        ]
                    ],
                    'process_section' => [
                        'title' => 'Your Roadmap to Approval',
                        'subtitle' => 'Step-by-Step',
                        'description' => 'A clear, structured timeline to ensure zero errors and maximum preparedness.',
                        'steps' => [
                            [
                                'number' => "01",
                                'title' => "Consultation",
                                'description' => "We assess your profile and funding to determine the best visa strategy."
                            ],
                            [
                                'number' => "02",
                                'title' => "Documentation",
                                'description' => "Collecting and organizing every required document flawlessly."
                            ],
                            [
                                'number' => "03",
                                'title' => "Application",
                                'description' => "Filling out visa forms (DS-160, etc.) with precision."
                            ],
                            [
                                'number' => "04",
                                'title' => "Interview Prep",
                                'description' => "Intensive training for your embassy interview."
                            ]
                        ]
                    ],
                    'cta_section' => [
                        'title' => "Don't Risk Your Visa Application",
                        'description' => "Get it right the first time with our expert guidance. Book a consultation today.",
                        'button_text' => "Book Visa Consultation",
                        'button_link' => "/apply-now"
                    ]
                ]
            ]
        );
    }
}
