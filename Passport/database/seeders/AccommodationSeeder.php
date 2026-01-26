<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccommodationSeeder extends Seeder
{
    public function run(): void
    {
        // Helper to find branch id by slug (school-branch)
        $getBranchId = function (string $schoolName, string $branchName): ?int {
            $slug = Str::slug(trim($schoolName) . '-' . trim($branchName));
            return DB::table('school_branches')->where('slug', $slug)->value('id');
        };

        // Cache lookup tables by their code columns
        $mealPlans      = DB::table('meal_plans')->pluck('id', 'meal_code');
        $bedroomTypes   = DB::table('bedroom_types')->pluck('id', 'bedroom_code');
        $bathroomTypes  = DB::table('bathroom_types')->pluck('id', 'bathroom_code');

        $rows = [
            // school, branch, meal, bedroom, bathroom, fee, admin, age, u18
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                'fee' => 230, 'admin' => null, 'age' => null, 'u18' => null],
            ['school' => 'Bath Academy of English', 'branch' => 'Bath', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',               'fee' => 255, 'admin' => 100,  'age' => 16,   'u18' => null],
            ['school' => 'Bayswater', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                           'fee' => 270, 'admin' => 50,   'age' => 16,   'u18' => 20],
            ['school' => 'Bayswater', 'branch' => 'Liverpool', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                        'fee' => 200, 'admin' => 50,   'age' => 16,   'u18' => 20],
            ['school' => 'Bayswater', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                         'fee' => 210, 'admin' => 50,   'age' => 16,   'u18' => 20],
            ['school' => 'Bayswater', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                      'fee' => 190, 'admin' => 50,   'age' => 16,   'u18' => 20],
            ['school' => 'Bayswater', 'branch' => 'Vancouver', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                        'fee' => 305, 'admin' => 225,  'age' => 19,   'u18' => 60],
            ['school' => 'Bayswater', 'branch' => 'Toronto', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                          'fee' => 290, 'admin' => 225,  'age' => 18,   'u18' => 60],
            ['school' => 'Bayswater', 'branch' => 'Calgary', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                          'fee' => 300, 'admin' => 225,  'age' => 18,   'u18' => 60],
            ['school' => 'Bayswater', 'branch' => 'Cape Town', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                        'fee' => 215, 'admin' => 55,   'age' => 16,   'u18' => null],
            ['school' => 'Bayswater', 'branch' => 'Cyprus (Limassol)', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                'fee' => 270, 'admin' => 55,   'age' => 16,   'u18' => null],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',           'fee' => 194, 'admin' => null, 'age' => 18,   'u18' => 17],
            ['school' => 'Berlitz', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                             'fee' => 245, 'admin' => 75,   'age' => 18,   'u18' => null],
            ['school' => 'Berlitz', 'branch' => 'Manchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                         'fee' => 220, 'admin' => 75,   'age' => 18,   'u18' => null],
            ['school' => 'Berlitz', 'branch' => 'Dublin', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',                             'fee' => 300, 'admin' => 75,   'age' => 18,   'u18' => null],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'SB',       'fee' => 190, 'admin' => 50,   'age' => 16,   'u18' => null],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 200, 'admin' => 35, 'age' => 18, 'u18' => null],
            ['school' => 'Britannia English Academy', 'branch' => 'Manchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 220, 'admin' => 65, 'age' => 18, 'u18' => 35],
            ['school' => 'BSC EDUCATION', 'branch' => 'Central London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',  'fee' => 295, 'admin' => null, 'age' => 16,  'u18' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',        'fee' => 260, 'admin' => null, 'age' => 16,  'u18' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'Manchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',      'fee' => 260, 'admin' => null, 'age' => 16,  'u18' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'York', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',            'fee' => 270, 'admin' => null, 'age' => 16,  'u18' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'Edinburgh', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',       'fee' => 260, 'admin' => null, 'age' => 16,  'u18' => null],
            ['school' => 'Burlington School', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',      'fee' => 280, 'admin' => 50,   'age' => 16,  'u18' => 25],
            ['school' => 'Central Language School', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 205, 'admin' => 60, 'age' => 18, 'u18' => null],
            ['school' => 'Concorde International ', 'branch' => 'Canterbury', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 203, 'admin' => null, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Dublin', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 280, 'admin' => 85, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Cork', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 270, 'admin' => 85, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Toronto', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 320, 'admin' => 275, 'age' => 18, 'u18' => 25],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Vancouver', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 360, 'admin' => 275, 'age' => 18, 'u18' => 25],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 280, 'admin' => 75, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Edinburgh', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 280, 'admin' => 75, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Oxford', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 280, 'admin' => 75, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Leeds', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 240, 'admin' => 75, 'age' => 18, 'u18' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Worthing', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 240, 'admin' => 75, 'age' => 18, 'u18' => null],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'shared bathroom', 'fee' => 205, 'admin' => 40, 'age' => 18, 'u18' => 10],
            ['school' => 'Eurospeak Language School ', 'branch' => 'Southampton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 205, 'admin' => 40, 'age' => 18, 'u18' => null],
            ['school' => 'Eurospeak Language School ', 'branch' => 'Reading', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 260, 'admin' => 40, 'age' => 18, 'u18' => null],
            ['school' => 'International House', 'branch' => 'Bristol', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 239, 'admin' => 62, 'age' => 18, 'u18' => 13],
            ['school' => 'Imagine English Liverpool Academy', 'branch' => 'Liverpool', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 180, 'admin' => 35, 'age' => null, 'u18' => null],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 215, 'admin' => 100, 'age' => 18, 'u18' => null],
            ['school' => 'International Language Centres', 'branch' => 'Birmingham', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 215, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'International Language Centres', 'branch' => 'Bristol', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 215, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'International Language Centres', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 230, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'International Language Centres', 'branch' => 'Colchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 230, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'International Language Centres', 'branch' => 'Portsmouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 215, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',       'fee' => 185, 'admin' => null, 'age' => null, 'u18' => null],
            ['school' => 'Islington Centre for English', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 310, 'admin' => 55, 'age' => 18, 'u18' => null],
            ['school' => 'Kensington Academy of English', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 285, 'admin' => 70, 'age' => 18, 'u18' => null],
            ['school' => 'Leeds Language College Ltd', 'branch' => 'centre of Leeds', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 250, 'admin' => 100, 'age' => 16, 'u18' => null],
            ['school' => 'Live Language School ', 'branch' => 'Glasgow', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',    'fee' => 220, 'admin' => 50,  'age' => null, 'u18' => null],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 185, 'admin' => 65, 'age' => 18, 'u18' => null],
            ['school' => 'LILA* College', 'branch' => 'Liverpool', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 190, 'admin' => 45,  'age' => 18, 'u18' => 25],
            ['school' => 'MC Academy', 'branch' => 'Liverpool', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',           'fee' => 225, 'admin' => 75,  'age' => 18, 'u18' => 25],
            ['school' => 'MC Academy', 'branch' => 'Manchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',          'fee' => 230, 'admin' => 75,  'age' => 18, 'u18' => 25],
            ['school' => 'Nacel English School', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',     'fee' => 240, 'admin' => 55,  'age' => 18, 'u18' => 15],
            ['school' => 'New College Group (NCG)', 'branch' => 'Liverpool', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 230, 'admin' => 75, 'age' => 16, 'u18' => 35],
            ['school' => 'New College Group (NCG)', 'branch' => 'Manchester', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 230, 'admin' => 75, 'age' => 16, 'u18' => 35],
            ['school' => 'Oxford International English Schools OIES', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 260, 'admin' => null, 'age' => 18, 'u18' => null],
            ['school' => 'Oxford International Study Centre', 'branch' => 'Oxford', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 275, 'admin' => null, 'age' => null, 'u18' => null],
            ['school' => 'Preston Academy of English', 'branch' => 'Preston', 'meal' => 'No', 'bedroom' => 'Single Room', 'bathroom' => 'Private Bathroom', 'fee' => 160, 'admin' => 50, 'age' => 18, 'u18' => null],
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 220, 'admin' => null, 'age' => 16, 'u18' => null],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 175, 'admin' => 10, 'age' => null, 'u18' => null],
            ['school' => 'St Giles International', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',  'fee' => 240, 'admin' => 75, 'age' => 16, 'u18' => 30],
            ['school' => 'St Giles International', 'branch' => 'Eastbourne', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 235, 'admin' => 75, 'age' => 16, 'u18' => 30],
            ['school' => 'St Giles International', 'branch' => 'London Central', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 250, 'admin' => 75, 'age' => 16, 'u18' => 30],
            ['school' => 'St Giles International', 'branch' => 'London Highgate', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 250, 'admin' => 75, 'age' => 16, 'u18' => 30],
            ['school' => 'St Giles International', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 245, 'admin' => 75, 'age' => 16, 'u18' => 30],
            ['school' => 'Stafford House', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',        'fee' => 245, 'admin' => 70, 'age' => 16, 'u18' => 30],
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',      'fee' => 240, 'admin' => 70, 'age' => 16, 'u18' => 30],
            ['school' => 'Stafford House', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',          'fee' => 270, 'admin' => 70, 'age' => 16, 'u18' => 30],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 265, 'admin' => 60, 'age' => 16, 'u18' => 25],
            ['school' => 'The London School of English', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom', 'fee' => 230, 'admin' => 70, 'age' => 16, 'u18' => null],
            ['school' => 'Twin English Centre', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',     'fee' => 260, 'admin' => 55, 'age' => 18, 'u18' => null],
            ['school' => 'UK College of English', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',   'fee' => 390, 'admin' => 50, 'age' => 18, 'u18' => null],
            ['school' => 'Westbourne Academy ', 'branch' => 'Bournemouth', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom','fee' => 195, 'admin' => null, 'age' => 17, 'u18' => null],
            ['school' => 'LSI Education', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',           'fee' => 260, 'admin' => 50, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Brighton', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 235, 'admin' => 50, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Cambridge', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',        'fee' => 245, 'admin' => 50, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'New York', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 430, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Boston', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',           'fee' => 400, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Berkeley', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 430, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'San Diego', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',        'fee' => 400, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Vancouver', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',        'fee' => 330, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Toronto', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',          'fee' => 330, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Auckland', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 355, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Brisbane', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',         'fee' => 365, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Paris', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',            'fee' => 290, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'LSI Education', 'branch' => 'Zurich', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',           'fee' => 330, 'admin' => 100, 'age' => 16, 'u18' => 20],
            ['school' => 'International House', 'branch' => 'London', 'meal' => 'HB', 'bedroom' => 'Single Room', 'bathroom' => 'Shared Bathroom',     'fee' => 287, 'admin' => 59, 'age' => 16, 'u18' => null],
        ];

        $toInsert = [];

        foreach ($rows as $row) {
            $branchId = $getBranchId($row['school'], $row['branch']);

            if (!$branchId) {
                // skip if branch not found (or you can dd/debug)
                continue;
            }

            // Map meal to code
            $mealCode = null;
            $meal = strtolower(trim($row['meal']));
            if ($meal === 'hb') {
                $mealCode = 'HALF_BOARD';
            } elseif ($meal === 'no') {
                $mealCode = 'SELF_CATERING';
            }

            $bedroomCode = 'SINGLE_STANDARD'; // all rows are Single Room

            $bathroomCode = null;
            $b = strtolower(trim($row['bathroom']));
            if ($b === 'sb') {
                $bathroomCode = 'SHARED_BATHROOM';
            } elseif (str_contains($b, 'shared')) {
                $bathroomCode = 'SHARED_BATHROOM';
            } elseif (str_contains($b, 'private')) {
                $bathroomCode = 'PRIVATE_BATHROOM';
            }

            // Skip rows we cannot map
            if (!$bathroomCode || !$mealCode) {
                continue;
            }

            $toInsert[] = [
                'school_branch_id'            => $branchId,
                'language_course_tag_id'      => null,
                'required_age'                => $row['age'],
                'fee_per_week'                => $row['fee'],
                'admin_charge'                => $row['admin'],
                'under18_supplement_per_week'=> $row['u18'],
                'bedroom_type_id'             => $bedroomTypes[$bedroomCode] ?? null,
                'bathroom_type_id'            => $bathroomTypes[$bathroomCode] ?? null,
                'meal_plan_id'                => $mealCode ? ($mealPlans[$mealCode] ?? null) : null,
                'notes'                       => null,
                'created_at'                  => now(),
                'updated_at'                  => now(),
            ];
        }

        if (!empty($toInsert)) {
            DB::table('accommodations')->insert($toInsert);
        }
    }
}
