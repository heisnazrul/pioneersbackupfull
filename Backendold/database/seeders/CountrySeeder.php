<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            // Top Destinations
            [
                'name' => 'United Kingdom',
                'ar_name' => 'المملكة المتحدة',
                'country_code' => 'GB',
                'currency_code' => 'GBP',
                'phone_code' => '44',
                'is_popular' => true,
                'continent' => 'Europe',
            ],
            [
                'name' => 'United States',
                'ar_name' => 'الولايات المتحدة',
                'country_code' => 'US',
                'currency_code' => 'USD',
                'phone_code' => '1',
                'is_popular' => true,
                'continent' => 'North America',
            ],
            [
                'name' => 'Canada',
                'ar_name' => 'كندا',
                'country_code' => 'CA',
                'currency_code' => 'CAD',
                'phone_code' => '1',
                'is_popular' => true,
                'continent' => 'North America',
            ],
            [
                'name' => 'Australia',
                'ar_name' => 'أستراليا',
                'country_code' => 'AU',
                'currency_code' => 'AUD',
                'phone_code' => '61',
                'is_popular' => true,
                'continent' => 'Oceania',
            ],
            [
                'name' => 'New Zealand',
                'ar_name' => 'نيوزيلندا',
                'country_code' => 'NZ',
                'currency_code' => 'NZD',
                'phone_code' => '64',
                'is_popular' => true,
                'continent' => 'Oceania',
            ],
            [
                'name' => 'Germany',
                'ar_name' => 'ألمانيا',
                'country_code' => 'DE',
                'currency_code' => 'EUR',
                'phone_code' => '49',
                'is_popular' => true,
                'continent' => 'Europe',
            ],
            [
                'name' => 'Cyprus',
                'ar_name' => 'قبرص',
                'country_code' => 'CY',
                'currency_code' => 'EUR',
                'phone_code' => '357',
                'is_popular' => true,
                'continent' => 'Europe',
            ],
            [
                'name' => 'Hungary',
                'ar_name' => 'المجر',
                'country_code' => 'HU',
                'currency_code' => 'HUF',
                'phone_code' => '36',
                'is_popular' => true,
                'continent' => 'Europe',
            ],

            // Other Countries
            [
                'name' => 'Bangladesh',
                'ar_name' => 'بنغلاديش',
                'country_code' => 'BD',
                'currency_code' => 'BDT',
                'phone_code' => '880',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'India',
                'ar_name' => 'الهند',
                'country_code' => 'IN',
                'currency_code' => 'INR',
                'phone_code' => '91',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Pakistan',
                'ar_name' => 'باكستان',
                'country_code' => 'PK',
                'currency_code' => 'PKR',
                'phone_code' => '92',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Saudi Arabia',
                'ar_name' => 'المملكة العربية السعودية',
                'country_code' => 'SA',
                'currency_code' => 'SAR',
                'phone_code' => '966',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'United Arab Emirates',
                'ar_name' => 'الإمارات العربية المتحدة',
                'country_code' => 'AE',
                'currency_code' => 'AED',
                'phone_code' => '971',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Qatar',
                'ar_name' => 'قطر',
                'country_code' => 'QA',
                'currency_code' => 'QAR',
                'phone_code' => '974',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Oman',
                'ar_name' => 'عمان',
                'country_code' => 'OM',
                'currency_code' => 'OMR',
                'phone_code' => '968',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Egypt',
                'ar_name' => 'مصر',
                'country_code' => 'EG',
                'currency_code' => 'EGP',
                'phone_code' => '20',
                'is_popular' => false,
                'continent' => 'Africa',
            ],
            [
                'name' => 'South Africa',
                'ar_name' => 'جنوب أفريقيا',
                'country_code' => 'ZA',
                'currency_code' => 'ZAR',
                'phone_code' => '27',
                'is_popular' => false,
                'continent' => 'Africa',
            ],
            [
                'name' => 'Ghana',
                'ar_name' => 'غانا',
                'country_code' => 'GH',
                'currency_code' => 'GHS',
                'phone_code' => '233',
                'is_popular' => false,
                'continent' => 'Africa',
            ],
            [
                'name' => 'China',
                'ar_name' => 'الصين',
                'country_code' => 'CN',
                'currency_code' => 'CNY',
                'phone_code' => '86',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
            [
                'name' => 'Japan',
                'ar_name' => 'اليابان',
                'country_code' => 'JP',
                'currency_code' => 'JPY',
                'phone_code' => '81',
                'is_popular' => false,
                'continent' => 'Asia',
            ],
        ];

        foreach ($countries as $country) {
            Country::firstOrCreate(
                ['country_code' => $country['country_code']],
                $country
            );
        }
    }
}
