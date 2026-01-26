<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BathroomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $bathrooms = [
            [
                'bathroom_code'   => 'SHARED_BATHROOM',
                'name'            => 'Shared bathroom',
                'ar_name'         => 'حمام مشترك',
                'description'     => 'A bathroom shared with other students or guests on the same floor or in the same apartment.',
                'ar_description'  => 'حمام مشترك مع طلاب أو نزلاء آخرين في نفس الطابق أو نفس الشقة.',
            ],
            [
                'bathroom_code'   => 'PRIVATE_BATHROOM',
                'name'            => 'Private bathroom',
                'ar_name'         => 'حمام خاص',
                'description'     => 'A private bathroom reserved only for the student, usually next to or inside the bedroom.',
                'ar_description'  => 'حمام خاص مخصص للطالب فقط، يكون عادة بجانب غرفة النوم أو داخلها.',
            ],
            [
                'bathroom_code'   => 'ENSUITE_BATHROOM',
                'name'            => 'En-suite bathroom',
                'ar_name'         => 'حمام داخلي (إن سويت)',
                'description'     => 'A modern en-suite bathroom directly connected to the bedroom with shower and toilet.',
                'ar_description'  => 'حمام حديث متصل مباشرة بغرفة النوم يحتوي على دش ومرحاض.',
            ],
            [
                'bathroom_code'   => 'FAMILY_SHARED_BATHROOM',
                'name'            => 'Family shared bathroom',
                'ar_name'         => 'حمام مشترك مع العائلة',
                'description'     => 'A bathroom shared with the host family in a homestay, cleaned regularly by the host.',
                'ar_description'  => 'حمام مشترك مع العائلة المضيفة في سكن عائلي، تقوم العائلة بتنظيفه بانتظام.',
            ],
            [
                'bathroom_code'   => 'PRIVATE_SHOWER_ONLY',
                'name'            => 'Private shower only',
                'ar_name'         => 'دش خاص فقط',
                'description'     => 'A small private shower cubicle for the student, with toilet facilities shared separately.',
                'ar_description'  => 'كابينة دش صغيرة خاصة بالطالب، مع مشاركة المرحاض في مكان منفصل.',
            ],
            [
                'bathroom_code'   => 'PREMIUM_PRIVATE_BATHROOM',
                'name'            => 'Premium private bathroom',
                'ar_name'         => 'حمام خاص مميز',
                'description'     => 'A larger private bathroom with upgraded fittings, often in premium or studio rooms.',
                'ar_description'  => 'حمام خاص أكبر بمرافق محسّنة، يكون غالباً في الغرف المميزة أو الاستوديو.',
            ],
        ];

        DB::table('bathroom_types')->insert($bathrooms);
    }
}
