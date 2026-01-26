<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BedroomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $bedrooms = [
            [
                'bedroom_code'    => 'SINGLE_STANDARD',
                'name'            => 'Single room (standard)',
                'ar_name'         => 'غرفة مفردة (عادية)',
                'description'     => 'A standard single room for one student with a comfortable bed and basic furniture.',
                'ar_description'  => 'غرفة مفردة عادية لطالب واحد مع سرير مريح وأثاث أساسي.',
            ],
            [
                'bedroom_code'    => 'SINGLE_SUPERIOR',
                'name'            => 'Single room (superior)',
                'ar_name'         => 'غرفة مفردة (مميزة)',
                'description'     => 'A larger or recently renovated single room with extra comfort and better finish.',
                'ar_description'  => 'غرفة مفردة أكبر أو مجددة حديثاً بتجهيزات أكثر راحة وتشطيبات أفضل.',
            ],
            [
                'bedroom_code'    => 'TWIN_SHARED',
                'name'            => 'Twin room (shared)',
                'ar_name'         => 'غرفة مزدوجة (مشتركة)',
                'description'     => 'A shared bedroom with two separate beds for two students staying together.',
                'ar_description'  => 'غرفة مشتركة تحتوي على سريرين منفصلين لطلاب اثنين يقيمون معاً.',
            ],
            [
                'bedroom_code'    => 'DOUBLE_SHARED',
                'name'            => 'Double room (shared)',
                'ar_name'         => 'غرفة مزدوجة بسرير واحد',
                'description'     => 'A room with one double bed suitable for a couple or two friends sharing.',
                'ar_description'  => 'غرفة تحتوي على سرير مزدوج واحد مناسبة للزوجين أو لصديقين يقيمان معاً.',
            ],
            [
                'bedroom_code'    => 'TWIN_ENSUITE',
                'name'            => 'Twin en-suite room',
                'ar_name'         => 'غرفة مزدوجة بحمام داخلي',
                'description'     => 'A twin room with a private en-suite bathroom shared only by the two students.',
                'ar_description'  => 'غرفة مزدوجة تحتوي على حمام داخلي خاص يستخدمه فقط الطالبان في الغرفة.',
            ],
            [
                'bedroom_code'    => 'STUDIO_SINGLE',
                'name'            => 'Single studio',
                'ar_name'         => 'استوديو مفرد',
                'description'     => 'A self-contained studio for one student with bedroom area, bathroom and kitchenette.',
                'ar_description'  => 'وحدة استوديو متكاملة لطالب واحد تضم منطقة نوم وحماماً ومطبخاً صغيراً.',
            ],
            [
                'bedroom_code'    => 'DORM_3_4_BEDS',
                'name'            => 'Dormitory (3–4 beds)',
                'ar_name'         => 'غرفة مشتركة (٣–٤ أسرة)',
                'description'     => 'A shared dormitory-style room with three to four beds for budget-friendly stays.',
                'ar_description'  => 'غرفة على طراز السكن الطلابي تحتوي على ثلاثة إلى أربعة أسرة للإقامة الاقتصادية.',
            ],
            [
                'bedroom_code'    => 'DORM_5_6_BEDS',
                'name'            => 'Dormitory (5–6 beds)',
                'ar_name'         => 'غرفة مشتركة (٥–٦ أسرة)',
                'description'     => 'A larger shared dormitory room with five or six beds, usually for groups.',
                'ar_description'  => 'غرفة مشتركة أكبر تحتوي على خمسة أو ستة أسرة، تُستخدم غالباً للمجموعات.',
            ],
        ];

        DB::table('bedroom_types')->insert($bedrooms);
    }
}
