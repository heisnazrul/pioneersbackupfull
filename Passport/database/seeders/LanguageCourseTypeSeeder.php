<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageCourseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $languageCourseTypes = [
            [
                'type_code'      => 'GENERAL_ENGLISH',
                'name'           => 'General English',
                'ar_name'        => 'الإنجليزية العامة',
                'description'    => 'General English focuses on everyday communication skills, helping students develop balanced speaking, listening, reading and writing abilities for study, travel and daily life.',
                'ar_description' => 'تركز دورة الإنجليزية العامة على مهارات التواصل اليومية، وتساعد الطلاب على تنمية قدراتهم في التحدث والاستماع والقراءة والكتابة بشكل متوازن من أجل الدراسة والسفر والحياة اليومية.',
            ],
            [
                'type_code'      => 'INTENSIVE_ENGLISH',
                'name'           => 'Intensive English',
                'ar_name'        => 'الإنجليزية المكثفة',
                'description'    => 'Intensive English offers more lesson hours each week so students can progress faster. It is ideal for learners who want quick improvement in all language skills within a shorter time.',
                'ar_description' => 'توفر دورة الإنجليزية المكثفة ساعات دراسية أكثر أسبوعياً ليتقدم الطالب بشكل أسرع. وهي مناسبة للمتعلمين الذين يرغبون في تحسين جميع مهاراتهم اللغوية خلال فترة زمنية أقصر.',
            ],
            [
                'type_code'      => 'SUPER_INTENSIVE_ENGLISH',
                'name'           => 'Super-Intensive English',
                'ar_name'        => 'الإنجليزية فائقة الكثافة',
                'description'    => 'Super-Intensive English is designed for very fast progress with a heavy weekly schedule. Students spend most of the day in class, practising English through lessons, projects and guided study.',
                'ar_description' => 'تم تصميم دورة الإنجليزية فائقة الكثافة لتحقيق تقدم سريع جداً مع جدول أسبوعي مكثف. يقضي الطلاب معظم اليوم في الصف، يمارسون اللغة من خلال الدروس والمشاريع والدراسة الموجهة.',
            ],
            [
                'type_code'      => 'SEMI_INTENSIVE_ENGLISH',
                'name'           => 'Semi-Intensive English',
                'ar_name'        => 'الإنجليزية نصف المكثفة',
                'description'    => 'Semi-Intensive English combines a solid number of lessons with free time for self-study, work or sightseeing. It suits students who want steady progress without a very heavy timetable.',
                'ar_description' => 'تجمع دورة الإنجليزية نصف المكثفة بين عدد جيد من الحصص ووقت فراغ للمذاكرة الذاتية أو العمل أو السياحة. وهي مناسبة للطلاب الذين يرغبون في تقدم ثابت دون جدول دراسي مرهق.',
            ],
            [
                'type_code'      => 'IELTS_PREPARATION',
                'name'           => 'IELTS Exam Preparation',
                'ar_name'        => 'دورة التحضير لاختبار IELTS',
                'description'    => 'IELTS Exam Preparation focuses on the four IELTS skills and exam techniques. Students practise real test tasks, learn timing strategies and receive feedback to reach their target band score.',
                'ar_description' => 'تركز دورة التحضير لاختبار IELTS على المهارات الأربع المطلوبة في الاختبار وأساليب التعامل مع الأسئلة. يتدرب الطلاب على نماذج حقيقية ويتعلمون استراتيجيات إدارة الوقت ويحصلون على تغذية راجعة للوصول إلى الدرجة المستهدفة.',
            ],
        ];

        DB::table('language_course_types')->insert($languageCourseTypes);
    }
}
