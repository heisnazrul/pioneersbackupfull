<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchRegistrationFeeSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
    ['slug' => 'anglotec-academy-scarborough', 'amount' => 150],
    ['slug' => 'atlantic-centre-of-education-galway', 'amount' => 65],
    ['slug' => 'bath-academy-of-english-bath', 'amount' => 65],

    ['slug' => 'bayswater-london', 'amount' => 95],
    ['slug' => 'bayswater-liverpool', 'amount' => 95],
    ['slug' => 'bayswater-brighton', 'amount' => 95],
    ['slug' => 'bayswater-bournemouth', 'amount' => 95],
    ['slug' => 'bayswater-vancouver', 'amount' => 190],
    ['slug' => 'bayswater-toronto', 'amount' => 190],
    ['slug' => 'bayswater-calgary', 'amount' => 190],
    ['slug' => 'bayswater-cape-town', 'amount' => 75],
    ['slug' => 'bayswater-limassol', 'amount' => 75],

    ['slug' => 'beet-language-centre-bournemouth', 'amount' => 115],

    ['slug' => 'berlitz-london', 'amount' => 75],
    ['slug' => 'berlitz-manchester', 'amount' => 75],
    ['slug' => 'berlitz-dublin', 'amount' => 75],

    ['slug' => 'bright-school-of-english-bournemouth', 'amount' => 50],
    ['slug' => 'bournemouth-city-college-bcc-bournemouth', 'amount' => 100],
    ['slug' => 'brighton-language-college-international-brighton', 'amount' => 65],
    ['slug' => 'britannia-english-academy-manchester', 'amount' => 65],

    ['slug' => 'burlington-school-london', 'amount' => 50],

    ['slug' => 'concorde-international-canterbury', 'amount' => 98],

    // CES (only London branch exists)
    ['slug' => 'ces-centre-of-english-studies-london', 'amount' => 85],

    ['slug' => 'etc-international-college-bournemouth', 'amount' => 100],

    ['slug' => 'eurospeak-language-school-southampton', 'amount' => 40],
    ['slug' => 'eurospeak-language-school-reading', 'amount' => 40],

    ['slug' => 'ih-international-house-london', 'amount' => 98],
    ['slug' => 'ih-international-house-bristol', 'amount' => 62],

    ['slug' => 'imagine-english-liverpool-academy-liverpool', 'amount' => 50],

    ['slug' => 'inlingua-cheltenham', 'amount' => 60],

    // ILC branches
    ['slug' => 'ilc-international-language-centres-birmingham', 'amount' => 80],
    ['slug' => 'ilc-international-language-centres-bristol', 'amount' => 80],
    ['slug' => 'ilc-international-language-centres-cambridge', 'amount' => 80],
    ['slug' => 'ilc-international-language-centres-colchester', 'amount' => 80],
    ['slug' => 'ilc-international-language-centres-portsmouth', 'amount' => 80],

    ['slug' => 'lsi-ih-portsmouth-portsmouth', 'amount' => 80],

    ['slug' => 'islington-centre-for-english-london', 'amount' => 80],

    ['slug' => 'kensington-academy-of-english-london', 'amount' => 100],

    ['slug' => 'leeds-language-college-ltd-leeds', 'amount' => 75],

    ['slug' => 'live-language-school-glasgow', 'amount' => 50],

    ['slug' => 'lewis-school-of-english-southampton', 'amount' => 65],

    ['slug' => 'lila-language-school-liverpool', 'amount' => 40],

    ['slug' => 'mc-academy-liverpool', 'amount' => 75],
    ['slug' => 'mc-academy-manchester', 'amount' => 75],

    ['slug' => 'nacel-english-school-london-finchley', 'amount' => 75],

    ['slug' => 'ncg-new-college-group-liverpool', 'amount' => 75],
    ['slug' => 'ncg-new-college-group-manchester', 'amount' => 75],

    ['slug' => 'oxford-international-english-schools-oies-brighton', 'amount' => 75],

    ['slug' => 'oxford-international-study-centre-oxford', 'amount' => 90],

    ['slug' => 'preston-academy-of-english-preston', 'amount' => 50],

    ['slug' => 'select-english-cambridge-cambridge', 'amount' => 50],

    ['slug' => 'southbourne-school-of-english-bournemouth', 'amount' => 120],

    ['slug' => 'st-giles-international-brighton', 'amount' => 80],
    ['slug' => 'st-giles-international-eastbourne', 'amount' => 80],
    ['slug' => 'st-giles-international-london-central', 'amount' => 80],
    ['slug' => 'st-giles-international-london-highgate', 'amount' => 80],
    ['slug' => 'st-giles-international-cambridge', 'amount' => 80],

    ['slug' => 'stafford-house-cambridge', 'amount' => 80],
    ['slug' => 'stafford-house-canterbury', 'amount' => 80],
    ['slug' => 'stafford-house-london', 'amount' => 80],

    ['slug' => 'wimbledon-school-of-english-london', 'amount' => 60],

    ['slug' => 'the-london-school-of-english-london', 'amount' => 100],

    ['slug' => 'twin-english-centre-london', 'amount' => 55],

    ['slug' => 'uk-college-of-english-london', 'amount' => 80],

    ['slug' => 'westbourne-academy-bournemouth', 'amount' => 100],

    // LSI Education branches
    ['slug' => 'lsi-education-london', 'amount' => 95],
    ['slug' => 'lsi-education-brighton', 'amount' => 95],
    ['slug' => 'lsi-education-cambridge', 'amount' => 95],
    ['slug' => 'lsi-education-new-york', 'amount' => 160],
    ['slug' => 'lsi-education-boston', 'amount' => 160],
    ['slug' => 'lsi-education-berkeley', 'amount' => 160],
    ['slug' => 'lsi-education-san-diego', 'amount' => 160],
    ['slug' => 'lsi-education-vancouver', 'amount' => 160],
    ['slug' => 'lsi-education-toronto', 'amount' => 160],
    ['slug' => 'lsi-education-auckland', 'amount' => 160],
    ['slug' => 'lsi-education-brisbane', 'amount' => 160],
    ['slug' => 'lsi-education-paris', 'amount' => 95],
    ['slug' => 'lsi-education-zurich', 'amount' => 110],
];


        foreach ($rows as $row) {
            $branchId = DB::table('school_branches')
                ->where('slug', $row['slug'])
                ->value('id');

            if (! $branchId) {
                echo "Branch not found: {$row['slug']}\n";
                continue;
            }

            $exists = DB::table('branch_registration_fees')
                ->where('branch_id', $branchId)
                ->exists();

            if ($exists) {
                continue;
            }

            DB::table('branch_registration_fees')->insert([
                'branch_id'  => $branchId,
                'amount'     => $row['amount'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
