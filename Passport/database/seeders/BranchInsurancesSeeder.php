<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SchoolBranch;
use App\Models\BranchInsurance;
use Illuminate\Support\Str;

class BranchInsurancesSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            ['school' => 'Bayswater', 'branch' => 'London',            'name' => 'International Student Insurance', 'fee' => 8.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Liverpool',         'name' => 'International Student Insurance', 'fee' => 8.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Brighton',          'name' => 'International Student Insurance', 'fee' => 8.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Bournemouth',       'name' => 'International Student Insurance', 'fee' => 8.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Cape Town',         'name' => 'International Student Insurance', 'fee' => 7.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Cyprus (Limassol)', 'name' => 'International Student Insurance', 'fee' => 7.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Vancouver', 'name' => 'International Student Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Toronto',   'name' => 'International Student Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Bayswater', 'branch' => 'Calgary',   'name' => 'International Student Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Berlitz', 'branch' => 'London',    'name' => 'Insurance', 'fee' => 35.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Berlitz', 'branch' => 'Manchester','name' => 'Insurance', 'fee' => 35.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Berlitz', 'branch' => 'Dublin', 'name' => 'Insurance', 'fee' => 125.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Britannia English Academy', 'branch' => 'Manchester', 'name' => 'Insurance', 'fee' => 12.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'BSC EDUCATION', 'branch' => 'Central London', 'name' => 'international student policy', 'fee' => 16.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'Brighton',       'name' => 'international student policy', 'fee' => 16.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'BSC EDUCATION', 'branch' => 'Manchester',     'name' => 'international student policy', 'fee' => 16.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Concorde International', 'branch' => 'Canterbury', 'name' => 'Full comprehensive insurance', 'fee' => 7.50, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'CES - Centre of English Studies', 'branch' => 'Dublin',   'name' => 'Medi-PEL',          'fee' => 130.00, 'billing_unit' => 'course', 'admin_charge' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Toronto',  'name' => 'Medical Insurance', 'fee' => 21.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Vancouver','name' => 'Medical Insurance', 'fee' => 21.00,  'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'International House', 'branch' => 'London',  'name' => 'GuardMe', 'fee' => 6.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'International House', 'branch' => 'Bristol', 'name' => 'GuardMe', 'fee' => 6.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Imagine English Liverpool Academy', 'branch' => 'Liverpool', 'name' => 'Medical Insurance', 'fee' => 7.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'LILA* College', 'branch' => 'Liverpool', 'name' => 'GuardMe', 'fee' => 6.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Nacel English School', 'branch' => 'London', 'name' => 'International Student Insurance', 'fee' => 5.80, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'name' => 'Insurance (with Guard.me)', 'fee' => 7.00, 'billing_unit' => 'week', 'admin_charge' => 5.00],

            ['school' => 'St Giles International', 'branch' => 'UK All', 'name' => 'Studentguard', 'fee' => 6.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'Stafford House', 'branch' => 'Cambridge',  'name' => 'International Student Insurance', 'fee' => 9.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'name' => 'International Student Insurance', 'fee' => 9.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'Stafford House', 'branch' => 'London',     'name' => 'International Student Insurance', 'fee' => 9.00, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'The London School of English', 'branch' => 'London', 'name' => 'Insurance', 'fee' => 11.12, 'billing_unit' => 'week', 'admin_charge' => null],

            ['school' => 'LSI Education', 'branch' => 'All UK Centres', 'name' => 'Insurance', 'fee' => 7.00,  'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'USA',        'name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'Canada',     'name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'New Zealand','name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'Australia',  'name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'Paris',      'name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
            ['school' => 'LSI Education', 'branch' => 'Zurich',     'name' => 'Insurance', 'fee' => 25.00, 'billing_unit' => 'week', 'admin_charge' => null],
        ];

        foreach ($rows as $row) {
            $slug = Str::slug($row['school'] . '-' . $row['branch']);
            $branch = SchoolBranch::where('slug', $slug)->first();

            if (! $branch) {
                continue;
            }

            BranchInsurance::updateOrCreate(
                [
                    'school_branch_id' => $branch->id,
                    'name'             => $row['name'],
                ],
                [
                    'fee'           => $row['fee'],
                    'admin_charge'  => $row['admin_charge'],
                    'billing_unit'  => $row['billing_unit'],
                    'billing_count' => 1,
                    'valid_from'    => null,
                    'valid_to'      => null,
                ]
            );
        }
    }
}
