<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LanguageCourseSeeder extends Seeder
{
    public function run(): void
    {
        $branchesTable = 'school_branches';

        // map course type codes
        $typeIds = DB::table('language_course_types')
            ->pluck('id', 'type_code')
            ->toArray();

        $tagIds = DB::table('language_course_tags')->pluck('id')->all();

        $typeByName = [
            'General English'         => 'GENERAL_ENGLISH',
            'Intensive English'       => 'INTENSIVE_ENGLISH',
            'Super-Intensive English' => 'SUPER_INTENSIVE_ENGLISH',
            'Semi-Intensive English'  => 'SEMI_INTENSIVE_ENGLISH',
            'IELTS Exam Preparation'  => 'IELTS_PREPARATION',
        ];

        // course name (EN) -> short AR label
        $courseArShort = [
            'General English'         => 'الإنجليزية العامة',
            'Intensive English'       => 'الإنجليزية المكثفة',
            'Super-Intensive English' => 'الإنجليزية فائقة الكثافة',
            'Semi-Intensive English'  => 'الإنجليزية نصف المكثفة',
            'IELTS Exam Preparation'  => 'التحضير لاختبار IELTS',
        ];

        $rows = [
            ['school' => 'Anglotec Academy', 'city' => 'Scarborough',  'course' => 'General English',        'level' => 'A1',  'study_time' => '17.5',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Atlantic Centre of Education', 'city' => 'Galway',      'course' => 'General English',  'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => null],
            ['school' => 'Atlantic Centre of Education', 'city' => 'Galway',      'course' => 'Intensive English','level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => null],
            ['school' => 'Bath Academy of English',      'city' => 'Bath',        'course' => 'General English',  'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bath Academy of English',      'city' => 'Bath',        'course' => 'Intensive English','level' => 'A1',  'study_time' => '23',    'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bath Academy of English',      'city' => 'Bath',        'course' => 'IELTS Exam Preparation','level' => 'B1','study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'London',    'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'London',    'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'London',    'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'London',    'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Liverpool', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Liverpool', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Liverpool', 'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Liverpool', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Brighton',  'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Brighton',  'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Brighton',  'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Brighton',  'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Bournemouth','course' => 'General English',       'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Bournemouth','course' => 'Intensive English',     'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Bournemouth', 'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Bournemouth', 'course' => 'IELTS Exam Preparation',  'level' => 'B1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Vancouver',   'course' => 'General English',         'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Vancouver',   'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Vancouver',   'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Vancouver',   'course' => 'IELTS Exam Preparation',  'level' => 'B1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Toronto',     'course' => 'General English',         'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Toronto',     'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Toronto',     'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Toronto',     'course' => 'IELTS Exam Preparation',  'level' => 'B1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Calgary',     'course' => 'General English',         'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Calgary',     'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Calgary',     'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Calgary',     'course' => 'IELTS Exam Preparation',  'level' => 'B1+', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Cape Town',   'course' => 'General English',         'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Cape Town',   'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Cape Town',   'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Cape Town',   'course' => 'IELTS Exam Preparation',  'level' => 'B1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bayswater', 'city' => 'Cyprus (Limassol)', 'course' => 'General English',   'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Cyprus (Limassol)', 'course' => 'Intensive English', 'level' => 'A1',  'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bayswater', 'city' => 'Cyprus (Limassol)', 'course' => 'IELTS Exam Preparation', 'level' => 'B1',  'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Beet Language Centre', 'city' => 'Bournemouth', 'course' => 'General English',         'level' => 'A1',  'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Beet Language Centre', 'city' => 'Bournemouth', 'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '18',  'lpw' => '24', 'min_age' => '16'],
            ['school' => 'Beet Language Centre', 'city' => 'Bournemouth', 'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '21',  'lpw' => '28', 'min_age' => '16'],

            ['school' => 'Berlitz', 'city' => 'London', 'course' => 'General English',         'level' => 'A1',  'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'London', 'course' => 'Intensive English',       'level' => 'A1',  'study_time' => '20', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'London', 'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '25', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Berlitz', 'city' => 'Manchester', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'Manchester', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '20', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'Manchester', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '25', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Berlitz', 'city' => 'Dublin', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'Dublin', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '20', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Berlitz', 'city' => 'Dublin', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '25', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Bournemouth City College BCC', 'city' => 'Bournemouth', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bournemouth City College BCC', 'city' => 'Bournemouth', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Bournemouth City College BCC', 'city' => 'Bournemouth', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '30',   'lpw' => '40', 'min_age' => '16'],
            ['school' => 'Bournemouth City College BCC', 'city' => 'Bournemouth', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Bright School of English', 'city' => 'Bournemouth', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Bright School of English', 'city' => 'Bournemouth', 'course' => 'General English',         'level' => 'A1', 'study_time' => '20', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Bright School of English', 'city' => 'Bournemouth', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '20', 'lpw' => '25', 'min_age' => '16'],

            ['school' => 'Brighton Language College International', 'city' => 'Brighton', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Brighton Language College International', 'city' => 'Brighton', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Britannia English Academy', 'city' => 'Manchester', 'course' => 'General English',         'level' => 'A1', 'study_time' => '16.66', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Britannia English Academy', 'city' => 'Manchester', 'course' => 'Semi-Intensive English',  'level' => 'A1', 'study_time' => '21.66', 'lpw' => '26', 'min_age' => '16'],
            ['school' => 'Britannia English Academy', 'city' => 'Manchester', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '25',    'lpw' => '30', 'min_age' => '16'],

            ['school' => 'BSC EDUCATION', 'city' => 'Central London', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'Central London', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20', 'lpw' => '24', 'min_age' => '16'],
            
            ['school' => 'BSC EDUCATION', 'city' => 'Brighton',       'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'Brighton', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20',    'lpw' => '24', 'min_age' => '16'],
            
            ['school' => 'BSC EDUCATION', 'city' => 'Manchester', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'Manchester', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20',  'lpw' => '24', 'min_age' => '16'],

            ['school' => 'BSC EDUCATION', 'city' => 'York', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'York', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20', 'lpw' => '24', 'min_age' => '16'],

            ['school' => 'BSC EDUCATION', 'city' => 'Edinburgh', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'Edinburgh', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20',   'lpw' => '24', 'min_age' => '16'],

            ['school' => 'BSC EDUCATION', 'city' => 'Malta', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '20',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'BSC EDUCATION', 'city' => 'Malta', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20',    'lpw' => '24', 'min_age' => '16'],

            ['school' => 'Burlington School', 'city' => 'London', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Burlington School', 'city' => 'London', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Central Language School', 'city' => 'Cambridge', 'course' => 'General English',   'level' => 'A1–C2', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Central Language School', 'city' => 'Cambridge', 'course' => 'Intensive English', 'level' => 'A1–C2', 'study_time' => '21', 'lpw' => '25', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'General English',   'level' => 'A1', 'study_time' => '18.33', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '23.83', 'lpw' => '26', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Dublin', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '18.33', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Cork', 'course' => 'General English',   'level' => 'A1', 'study_time' => '18.33', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Cork', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '23.83', 'lpw' => '26', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Cork', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '18.33', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Toronto', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Toronto', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Toronto', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Toronto', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Vancouver', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Vancouver', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Vancouver', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Vancouver', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '18.75', 'lpw' => '25', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'London', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'London', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'London', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Edinburgh', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Edinburgh', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Edinburgh', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Oxford', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Oxford', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Oxford', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Leeds', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Leeds', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Leeds', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'CES - Centre of English Studies', 'city' => 'Worthing', 'course' => 'General English',   'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Worthing', 'course' => 'Intensive English', 'level' => 'A1', 'study_time' => '22',   'lpw' => '30', 'min_age' => '16'],
            ['school' => 'CES - Centre of English Studies', 'city' => 'Worthing', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Concorde International', 'city' => 'Canterbury', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Concorde International', 'city' => 'Canterbury', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '21',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Concorde International', 'city' => 'Canterbury', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '25',  'lpw' => '35', 'min_age' => '16'],
            ['school' => 'Concorde International', 'city' => 'Canterbury', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '10',  'lpw' => '10', 'min_age' => '16'],

            ['school' => 'ETC International College', 'city' => 'Bournemouth', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'ETC International College', 'city' => 'Bournemouth', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '18', 'lpw' => '24', 'min_age' => '16'],
            ['school' => 'ETC International College', 'city' => 'Bournemouth', 'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '21', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'ETC International College', 'city' => 'Bournemouth', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Eurospeak Language School', 'city' => 'Southampton', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Eurospeak Language School', 'city' => 'Southampton', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '12', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Eurospeak Language School', 'city' => 'Reading',     'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Eurospeak Language School', 'city' => 'Reading',     'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '12', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'International House', 'city' => 'Bristol', 'course' => 'General English',        'level' => 'A2', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International House', 'city' => 'Bristol', 'course' => 'Intensive English',      'level' => 'A2', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International House', 'city' => 'Bristol', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'International House', 'city' => 'London', 'course' => 'General English',        'level' => 'A2', 'study_time' => '13.75', 'lpw' => '15', 'min_age' => '16'],
            ['school' => 'International House', 'city' => 'London', 'course' => 'General English',        'level' => 'A2', 'study_time' => '18',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International House', 'city' => 'London', 'course' => 'Semi-Intensive English', 'level' => 'A2', 'study_time' => '23',    'lpw' => '25', 'min_age' => '16'],
            ['school' => 'International House', 'city' => 'London', 'course' => 'Intensive English',      'level' => 'A2', 'study_time' => '27.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Imagine English Liverpool Academy', 'city' => 'Liverpool', 'course' => 'General English', 'level' => 'A1', 'study_time' => '18.75', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'inlingua', 'city' => 'Cheltenham', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'inlingua', 'city' => 'Cheltenham', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'inlingua', 'city' => 'Cheltenham', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'International Language Centres', 'city' => 'Birmingham', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Birmingham', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Birmingham', 'course' => 'IELTS Exam Preparation', 'level' => 'A2', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'International Language Centres', 'city' => 'Bristol', 'course' => 'General English',        'level' => 'A1',  'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Bristol', 'course' => 'Intensive English',      'level' => 'A1',  'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Bristol', 'course' => 'IELTS Exam Preparation', 'level' => 'A2',  'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],

            ['school' => 'International Language Centres', 'city' => 'Cambridge', 'course' => 'General English',        'level' => 'A1',  'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Cambridge', 'course' => 'Intensive English',      'level' => 'A1',  'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Cambridge', 'course' => 'IELTS Exam Preparation', 'level' => 'A2+', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],

            ['school' => 'International Language Centres', 'city' => 'Colchester', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Colchester', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Colchester', 'course' => 'IELTS Exam Preparation', 'level' => 'A2', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Portsmouth', 'course' => 'General English',        'level' => 'A1',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Portsmouth', 'course' => 'Intensive English',      'level' => '',    'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'International Language Centres', 'city' => 'Portsmouth', 'course' => 'IELTS Exam Preparation', 'level' => 'A2',  'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Islington Centre for English', 'city' => 'London', 'course' => 'General English',         'level' => 'A1',  'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Islington Centre for English', 'city' => 'London', 'course' => 'Super-Intensive English', 'level' => 'A1',  'study_time' => '25',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Islington Centre for English', 'city' => 'London', 'course' => 'IELTS Exam Preparation',  'level' => 'B2',  'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Kensington Academy of English', 'city' => 'London', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Kensington Academy of English', 'city' => 'London', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '21', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'Kensington Academy of English', 'city' => 'London', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '25', 'lpw' => '32', 'min_age' => '16'],

            ['school' => 'Leeds Language College Ltd', 'city' => 'centre of Leeds', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Leeds Language College Ltd', 'city' => 'centre of Leeds', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '20',  'lpw' => '26', 'min_age' => '16'],
            ['school' => 'Leeds Language College Ltd', 'city' => 'centre of Leeds', 'course' => 'IELTS Exam Preparation', 'level' => 'B2', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Lewis School of English', 'city' => 'Southampton', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20',  'min_age' => '16'],
            ['school' => 'Lewis School of English', 'city' => 'Southampton', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '30',  'lpw' => '22.5','min_age' => '16'],

            ['school' => 'LILA* College', 'city' => 'Liverpool', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LILA* College', 'city' => 'Liverpool', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'LILA* College', 'city' => 'Liverpool', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '21', 'lpw' => '28', 'min_age' => '16'],

            ['school' => 'Live Language School', 'city' => 'Glasgow', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Live Language School', 'city' => 'Glasgow', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '26', 'min_age' => '16'],
            ['school' => 'Live Language School', 'city' => 'Glasgow', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],

            ['school' => 'LSI/IH Portsmouth', 'city' => 'Portsmouth', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI/IH Portsmouth', 'city' => 'Portsmouth', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'MC Academy', 'city' => 'Liverpool', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'MC Academy', 'city' => 'Liverpool', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21',  'lpw' => '28', 'min_age' => '16'],
            ['school' => 'MC Academy', 'city' => 'Liverpool', 'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '25',  'lpw' => '32', 'min_age' => '16'],

            ['school' => 'MC Academy', 'city' => 'Manchester', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'MC Academy', 'city' => 'Manchester', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21',  'lpw' => '28', 'min_age' => '16'],
            ['school' => 'MC Academy', 'city' => 'Manchester', 'course' => 'Super-Intensive English','level' => 'A1', 'study_time' => '25',  'lpw' => '32', 'min_age' => '16'],

            ['school' => 'Nacel English School', 'city' => 'London', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Nacel English School', 'city' => 'London', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '24',  'lpw' => '32', 'min_age' => '16'],
            ['school' => 'Nacel English School', 'city' => 'London', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '30',  'lpw' => '40', 'min_age' => '16'],
            ['school' => 'Nacel English School', 'city' => 'London', 'course' => 'IELTS Exam Preparation', 'level' => 'A2', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Oxford International English Schools OIES', 'city' => 'Brighton', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Oxford International English Schools OIES', 'city' => 'Brighton', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '22.5','lpw' => '30', 'min_age' => '16'],
            ['school' => 'Oxford International English Schools OIES', 'city' => 'Brighton', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '30', 'lpw' => '40', 'min_age' => '16'],
            ['school' => 'Oxford International English Schools OIES', 'city' => 'Brighton', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Oxford International Study Centre', 'city' => 'Oxford', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Oxford International Study Centre', 'city' => 'Oxford', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'Preston Academy of English', 'city' => 'Preston', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Preston Academy of English', 'city' => 'Preston', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Preston Academy of English', 'city' => 'Preston', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '25',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Select English Cambridge', 'city' => 'Cambridge', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Select English Cambridge', 'city' => 'Cambridge', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21',  'lpw' => '28', 'min_age' => '16'],
            ['school' => 'Select English Cambridge', 'city' => 'Cambridge', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '24',  'lpw' => '32', 'min_age' => '16'],

            ['school' => 'Southbourne School of English', 'city' => 'Bournemouth', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '20'],
            ['school' => 'Southbourne School of English', 'city' => 'Bournemouth', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '21',  'lpw' => '25', 'min_age' => '16'],

            ['school' => 'St Giles International', 'city' => 'Brighton', 'course' => 'General English',        'level' => 'A1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Brighton', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '23.3', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Brighton', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'St Giles International', 'city' => 'Eastbourne', 'course' => 'General English',        'level' => 'A1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Eastbourne', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '23.3', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Eastbourne', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'St Giles International', 'city' => 'London Central', 'course' => 'General English',        'level' => 'A1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'London Central', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '23.3', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'London Central', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'St Giles International', 'city' => 'London Highgate', 'course' => 'General English',        'level' => 'A1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'London Highgate', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '23.3', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'London Highgate', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'St Giles International', 'city' => 'Cambridge', 'course' => 'General English',        'level' => 'A1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Cambridge', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '23.3', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'St Giles International', 'city' => 'Cambridge', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '16.7', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Stafford House', 'city' => 'Cambridge', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Cambridge', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '19',  'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Cambridge', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '23',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Cambridge', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Stafford House', 'city' => 'Canterbury', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Canterbury', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '19', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Canterbury', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '23', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'Canterbury', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Stafford House', 'city' => 'London', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'London', 'course' => 'Intensive English',       'level' => 'A1', 'study_time' => '19', 'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'London', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '23', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Stafford House', 'city' => 'London', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Wimbledon School of English', 'city' => 'London', 'course' => 'General English',        'level' => 'A2', 'study_time' => '21',   'lpw' => '25', 'min_age' => '16'],
            ['school' => 'Wimbledon School of English', 'city' => 'London', 'course' => 'Intensive English',      'level' => 'A2', 'study_time' => '24.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'Wimbledon School of English', 'city' => 'London', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '21',   'lpw' => '25', 'min_age' => '16'],

            ['school' => 'The London School of English', 'city' => 'London', 'course' => 'General English',   'level' => 'A2', 'study_time' => '12', 'lpw' => '15', 'min_age' => '20'],
            ['school' => 'The London School of English', 'city' => 'London', 'course' => 'Intensive English', 'level' => 'A2', 'study_time' => '24', 'lpw' => '30', 'min_age' => '20'],

            ['school' => 'Twin English Centre', 'city' => 'London', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Twin English Centre', 'city' => 'London', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '21', 'lpw' => '28', 'min_age' => '16'],

            ['school' => 'UK College of English', 'city' => 'London', 'course' => 'General English',         'level' => 'A1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],
            ['school' => 'UK College of English', 'city' => 'London', 'course' => 'Super-Intensive English', 'level' => 'A1', 'study_time' => '27',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'UK College of English', 'city' => 'London', 'course' => 'IELTS Exam Preparation',  'level' => 'B1', 'study_time' => '15',  'lpw' => '20', 'min_age' => '16'],

            ['school' => 'Westbourne Academy', 'city' => 'Bournemouth', 'course' => 'General English',        'level' => 'A1', 'study_time' => '13', 'lpw' => '20', 'min_age' => '16'],
            ['school' => 'Westbourne Academy', 'city' => 'Bournemouth', 'course' => 'Semi-Intensive English', 'level' => 'A2', 'study_time' => '18', 'lpw' => '28', 'min_age' => '16'],
            ['school' => 'Westbourne Academy', 'city' => 'Bournemouth', 'course' => 'Intensive English',      'level' => 'A2', 'study_time' => '26', 'lpw' => '40', 'min_age' => '16'],
            ['school' => 'Westbourne Academy', 'city' => 'Bournemouth', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '13', 'lpw' => '20', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'London', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'London', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'London', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'London', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brighton', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brighton', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brighton', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brighton', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Cambridge', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Cambridge', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Cambridge', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Cambridge', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'New York', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'New York', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'New York', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'New York', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Boston', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Boston', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Boston', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Boston', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Berkeley', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Berkeley', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Berkeley', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Berkeley', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'San Diego', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',   'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'San Diego', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',   'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'San Diego', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'San Diego', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5', 'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Vancouver', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Vancouver', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Vancouver', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Vancouver', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Toronto', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Toronto', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Toronto', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Toronto', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Auckland', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Auckland', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Auckland', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Auckland', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Brisbane', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brisbane', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brisbane', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Brisbane', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Paris', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Paris', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Paris', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Paris', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],

            ['school' => 'LSI Education', 'city' => 'Zurich', 'course' => 'General English',        'level' => 'A1', 'study_time' => '15',    'lpw' => '20', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Zurich', 'course' => 'Semi-Intensive English', 'level' => 'A1', 'study_time' => '18',    'lpw' => '24', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Zurich', 'course' => 'Intensive English',      'level' => 'A1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],
            ['school' => 'LSI Education', 'city' => 'Zurich', 'course' => 'IELTS Exam Preparation', 'level' => 'B1', 'study_time' => '22.5',  'lpw' => '30', 'min_age' => '16'],


        ];

        if (empty($typeIds)) {
            return;
        }

        $courses = [];
        $tagIndex = 0;

        foreach ($rows as $row) {
            $school = $row['school'];
            $city   = $row['city'];
            $course = $row['course'];

            $branchSlug = Str::slug($school.'-'.$city);

            $branchId = DB::table($branchesTable)
                ->where('slug', $branchSlug)
                ->value('id');

            if (! $branchId) {
                continue;
            }

            $typeCode = $typeByName[$course] ?? 'GENERAL_ENGLISH';
            $typeId   = $typeIds[$typeCode] ?? reset($typeIds);

            $languageCourseTagId = null;
            if (!empty($tagIds)) {
                $languageCourseTagId = $tagIds[$tagIndex % count($tagIds)];
                $tagIndex++;
            }

            $slug = Str::slug($school.'-'.$city.'-'.$course.'-'.$row['lpw']);

            // course AR label
            $courseAr = $courseArShort[$course] ?? $course;

            $description = "This course consists of {$row['lpw']} lessons per week ({$row['study_time']} hours per week).";
            $arDescription = "تتكون هذه الدورة من {$row['lpw']} درساً في الأسبوع ({$row['study_time']} ساعة أسبوعياً).";

            $courses[] = [
                'branch_id'               => $branchId,
                'language_course_type_id' => $typeId,
                'language_course_tag_id'  => $languageCourseTagId,
                'slug'                    => $slug,
                'name'                    => $course,
                'ar_name'                 => 'دورة '.$courseAr,
                'description'             => $description,
                'ar_description'          => $arDescription,
                'start_day'               => 'Every Monday',
                'required_level'          => $row['level'],
                'study_time'              => $row['study_time'],
                'lessons_per_week'        => $row['lpw'],
                'min_age'                 => $row['min_age'],
                'created_at'              => now(),
                'updated_at'              => now(),
            ];
        }

        if ($courses) {
            DB::table('language_courses')->insert($courses);
        }
    }
}
