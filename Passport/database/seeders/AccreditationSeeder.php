<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccreditationSeeder extends Seeder
{
    public function run(): void
    {
        $accreditations = [
    [
        'name' => 'British Council',
        'ar_name' => 'المجلس الثقافي البريطاني',
        'picture' => null,
    ],
    [
        'name' => 'English UK',
        'ar_name' => 'إنجلش يو كيه',
        'picture' => null,
    ],
    [
        'name' => 'Cambridge English',
        'ar_name' => 'كامبريدج إنجلش',
        'picture' => null,
    ],
    [
        'name' => 'Trinity College London',
        'ar_name' => 'ترينيتي كوليدج لندن',
        'picture' => null,
    ],
    [
        'name' => 'UCAS',
        'ar_name' => 'يوكاس',
        'picture' => null,
    ],
    [
        'name' => 'Erasmus+',
        'ar_name' => 'إيراسموس+',
        'picture' => null,
    ],
    [
        'name' => 'IALC',
        'ar_name' => 'آي إيه إل سي',
        'picture' => null,
    ],
    [
        'name' => 'Quality English',
        'ar_name' => 'كوالتي إنجلش',
        'picture' => null,
    ],
    [
        'name' => 'Languages Canada',
        'ar_name' => 'لانغويتجز كندا',
        'picture' => null,
    ],
    [
        'name' => 'ACELS',
        'ar_name' => 'آيسيلس',
        'picture' => null,
    ],
    [
        'name' => 'ASIC',
        'ar_name' => 'آسيك',
        'picture' => null,
    ],
    [
        'name' => 'ALTO',
        'ar_name' => 'ألتو',
        'picture' => null,
    ],
    [
        'name' => 'PFE',
        'ar_name' => 'بي إف إي',
        'picture' => null,
    ],
    [
        'name' => 'OET',
        'ar_name' => 'اختبار OET',
        'picture' => null,
    ],
    [
        'name' => 'EPALE',
        'ar_name' => 'إيبالي',
        'picture' => null,
    ],
    [
        'name' => 'AELS',
        'ar_name' => 'إيه إي إل إس',
        'picture' => null,
    ],
    [
        'name' => 'IEA',
        'ar_name' => 'آي إي إيه',
        'picture' => null,
    ],
    [
        'name' => 'SQA',
        'ar_name' => 'هيئة المؤهلات الاسكتلندية SQA',
        'picture' => null,
    ],
    [
        'name' => 'Investors in People',
        'ar_name' => 'إنفستورز إن بيبول',
        'picture' => null,
    ],
    [
        'name' => 'The English Network',
        'ar_name' => 'ذا إنجلش نتوورك',
        'picture' => null,
    ],
    [
        'name' => 'LanguageCert',
        'ar_name' => 'لانغويتج سيرت',
        'picture' => null,
    ],
    [
        'name' => 'NatGeo Learning',
        'ar_name' => 'نات جيو ليرنينغ',
        'picture' => null,
    ],
    [
        'name' => 'MTS',
        'ar_name' => 'إم تي إس',
        'picture' => null,
    ],
    [
        'name' => 'NCUK',
        'ar_name' => 'إن سي يو كيه',
        'picture' => null,
    ],
    [
        'name' => 'ELT Council Malta',
        'ar_name' => 'مجلس تعليم الإنجليزية في مالطا',
        'picture' => null,
    ],
    [
        'name' => 'We’re Good To Go',
        'ar_name' => 'برنامج وي آر جود تو جو',
        'picture' => null,
    ],
    [
        'name' => 'BETA',
        'ar_name' => 'بيتا (رابطة السفر التعليمي البريطانية)',
        'picture' => null,
    ],
];


        if (!empty($accreditations)) {
            DB::table('accreditations')->insert($accreditations);
        }
    }
}
