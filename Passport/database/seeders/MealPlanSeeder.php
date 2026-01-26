<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealPlanSeeder extends Seeder
{
    public function run(): void
    {
        $meals = [
            [
                'meal_code'       => 'SELF_CATERING',
                'name'            => 'Self-catering',
                'ar_name'         => 'إعاشة ذاتية',
                'description'     => 'No meals are provided; the student prepares their own food using a shared or private kitchen.',
                'ar_description'  => 'لا يتم تقديم وجبات، حيث يقوم الطالب بإعداد طعامه بنفسه باستخدام مطبخ مشترك أو خاص.',
            ],
            [
                'meal_code'       => 'BED_AND_BREAKFAST',
                'name'            => 'Bed and breakfast (BB)',
                'ar_name'         => 'سرير مع إفطار',
                'description'     => 'Accommodation with daily breakfast included, ideal for students who eat lunch and dinner outside.',
                'ar_description'  => 'إقامة تشمل وجبة الإفطار اليومية، مناسبة للطلاب الذين يتناولون الغداء والعشاء خارج السكن.',
            ],
            [
                'meal_code'       => 'HALF_BOARD',
                'name'            => 'Half board (HB)',
                'ar_name'         => 'نصف إقامة (إفطار وعشاء)',
                'description'     => 'Includes breakfast and evening meal each day, a common option for homestay accommodation.',
                'ar_description'  => 'تشمل وجبة الإفطار ووجبة المساء يومياً، وهي خيار شائع في السكن العائلي.',
            ],
            [
                'meal_code'       => 'FULL_BOARD',
                'name'            => 'Full board (FB)',
                'ar_name'         => 'إقامة كاملة',
                'description'     => 'Includes breakfast, lunch and dinner every day, suitable for younger learners or closed campuses.',
                'ar_description'  => 'تشمل الإفطار والغداء والعشاء يومياً، مناسبة للطلاب الصغار أو برامج السكن المغلق.',
            ],
            [
                'meal_code'       => 'WEEKDAY_LUNCH_ADDON',
                'name'            => 'Weekday hot lunch add-on',
                'ar_name'         => 'إضافة غداء ساخن في أيام الأسبوع',
                'description'     => 'An optional extra hot lunch in the school cafeteria from Monday to Friday on top of homestay meals.',
                'ar_description'  => 'إضافة اختيارية لوجبة غداء ساخنة في كافيتريا المدرسة من الاثنين إلى الجمعة بجانب وجبات السكن العائلي.',
            ],
            [
                'meal_code'       => 'SPECIAL_DIET_HALF_BOARD',
                'name'            => 'Half board with special diet',
                'ar_name'         => 'نصف إقامة مع نظام غذائي خاص',
                'description'     => 'Half board meals adapted for special dietary needs such as halal, vegetarian or gluten-free.',
                'ar_description'  => 'نصف إقامة مع تعديل الوجبات لتناسب أنظمة غذائية خاصة مثل الحلال أو النباتي أو الخالي من الغلوتين.',
            ],
        ];

        DB::table('meal_plans')->insert($meals);
    }
}
