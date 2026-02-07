<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Destination;
use App\Models\DestinationFeature;
use App\Models\DestinationStat;
use App\Models\DestinationIntake;
use App\Models\DestinationFaq;
use App\Models\DestinationRequirement;
use App\Models\DestinationDiscipline;
use App\Models\Country;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Schema::disableForeignKeyConstraints();
        Destination::truncate();
        DestinationFeature::truncate();
        DestinationStat::truncate();
        DestinationIntake::truncate();
        DestinationFaq::truncate();
        DestinationRequirement::truncate();
        DestinationDiscipline::truncate();
        Schema::enableForeignKeyConstraints();

        $json = '[
  {
    "id": "dest_GB",
    "slug": "united-kingdom",
    "name": "United Kingdom",
    "region": "Europe",
    "description": "Study in United Kingdom and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=United Kingdom",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "GBP 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_US",
    "slug": "united-states",
    "name": "United States",
    "region": "North America",
    "description": "Study in United States and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=United States",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "USD 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_CA",
    "slug": "canada",
    "name": "Canada",
    "region": "North America",
    "description": "Study in Canada and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Canada",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "CAD 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_AU",
    "slug": "australia",
    "name": "Australia",
    "region": "Oceania",
    "description": "Study in Australia and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Australia",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "AUD 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_DE",
    "slug": "germany",
    "name": "Germany",
    "region": "Europe",
    "description": "Study in Germany and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Germany",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "EUR 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_IE",
    "slug": "ireland",
    "name": "Ireland",
    "region": "Europe",
    "description": "Study in Ireland and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Ireland",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "EUR 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_NL",
    "slug": "netherlands",
    "name": "Netherlands",
    "region": "Europe",
    "description": "Study in Netherlands and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Netherlands",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "EUR 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  },
  {
    "id": "dest_MY",
    "slug": "malaysia",
    "name": "Malaysia",
    "region": "Asia",
    "description": "Study in Malaysia and experience world-class education. Known for its academic excellence and vibrant culture, it\'s a top choice for international students.",
    "imageUrl": "https://placehold.co/800x600?text=Malaysia",
    "shortPitch": "World-renowned degrees & post-study work rights.",
    "tuitionRange": "MYR 15,000 - 35,000 / year",
    "visaTimeline": "4-6 weeks",
    "workRights": "Up to 3 years post-study",
    "scholarships": "Government & University mandated",
    "features": [
      "High Quality Education",
      "Multicultural Society",
      "Global Recognition"
    ],
    "stats": [
      {
        "label": "Universities",
        "value": "20+"
      },
      {
        "label": "Intl. Students",
        "value": "500k+"
      },
      {
        "label": "Post-Study Work",
        "value": "Yes"
      }
    ],
    "popularDisciplines": [
      "Business",
      "Engineering",
      "Health",
      "IT"
    ],
    "intakeTimeline": [
      {
        "month": "Jan",
        "event": "Winter Intake"
      },
      {
        "month": "May",
        "event": "Spring Intake"
      },
      {
        "month": "Sep",
        "event": "Fall Intake (Main)"
      }
    ],
    "requirements": [
      "Academic Transcripts",
      "English Proficiency (IELTS/TOEFL)",
      "Statement of Purpose",
      "Financial Proof"
    ],
    "faqs": [
      {
        "question": "Can I work while studying?",
        "answer": "Yes, usually 20 hours per week during term time."
      },
      {
        "question": "Are scholarships available?",
        "answer": "Yes, many universities offer merit-based scholarships."
      }
    ]
  }
]';

        $destinations = json_decode($json, true);

        foreach ($destinations as $data) {
            // Find Country if exists
            $country = Country::where('slug', $data['slug'])->first();

            $dest = Destination::create([
                'slug' => $data['slug'],
                'name' => $data['name'],
                'country_id' => $country ? $country->id : null,
                'region' => $data['region'],
                'description' => $data['description'],
                'image_url' => $data['imageUrl'],
                'short_pitch' => $data['shortPitch'],
                'tuition_range' => $data['tuitionRange'],
                'visa_timeline' => $data['visaTimeline'],
                'work_rights' => $data['workRights'],
                'scholarships_summary' => $data['scholarships'],
                'university_count' => 0, // Placeholder
                'is_active' => true,
            ]);

            // Features
            foreach ($data['features'] as $feature) {
                DestinationFeature::create([
                    'destination_id' => $dest->id,
                    'feature' => $feature,
                ]);
            }

            // Stats
            foreach ($data['stats'] as $stat) {
                DestinationStat::create([
                    'destination_id' => $dest->id,
                    'label' => $stat['label'],
                    'value' => $stat['value'],
                ]);
            }

            // Intakes
            if (isset($data['intakeTimeline'])) {
                foreach ($data['intakeTimeline'] as $intake) {
                    DestinationIntake::create([
                        'destination_id' => $dest->id,
                        'month' => $intake['month'],
                        'event' => $intake['event'],
                    ]);
                }
            }

            // FAQs
            if (isset($data['faqs'])) {
                foreach ($data['faqs'] as $faq) {
                    DestinationFaq::create([
                        'destination_id' => $dest->id,
                        'question' => $faq['question'],
                        'answer' => $faq['answer'],
                    ]);
                }
            }

            // Requirements
            if (isset($data['requirements'])) {
                foreach ($data['requirements'] as $req) {
                    DestinationRequirement::create([
                        'destination_id' => $dest->id,
                        'requirement' => $req,
                    ]);
                }
            }

            // Disciplines
            if (isset($data['popularDisciplines'])) {
                foreach ($data['popularDisciplines'] as $disc) {
                    DestinationDiscipline::create([
                        'destination_id' => $dest->id,
                        'discipline' => $disc,
                    ]);
                }
            }
        }
    }
}
