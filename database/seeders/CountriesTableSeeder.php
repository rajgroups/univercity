<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('countries')->truncate();
        
        // Seed India directly
        $countries = [
            [
                'id' => 101,
                'name' => 'India',
                'iso3' => 'IND',
                'numeric_code' => '356',
                'iso2' => 'IN',
                'phonecode' => '91',
                'capital' => 'New Delhi',
                'currency' => 'INR',
                'currency_name' => 'Indian rupee',
                'currency_symbol' => '₹',
                'tld' => '.in',
                'native' => 'भारत',
                'region' => 'Asia',
                'region_id' => 3,
                'subregion' => 'Southern Asia',
                'subregion_id' => 14,
                'nationality' => 'Indian',
                'timezones' => '[{"zoneName":"Asia/Kolkata","gmtOffset":19800,"gmtOffsetName":"UTC+05:30","abbreviation":"IST","tzName":"Indian Standard Time"}]',
                'translations' => '{"br": "India","ko":"인도","pt-BR":"Índia","pt":"Índia","nl":"India","hr":"Indija","fa":"هند","de":"Indien","es":"India","fr":"Inde","ja":"インド","it":"India","zh-CN":"印度","tr":"Hindistan","ru":"Индия","uk":"Індія","pl":"Indie"}',
                'latitude' => 20.00000000,
                'longitude' => 77.00000000,
                'emoji' => '🇮🇳',
                'emojiU' => 'U+1F1EE U+1F1F3',
                'created_at' => '2018-07-21 07:11:03',
                'updated_at' => '2023-08-08 21:04:58',
                'flag' => 1,
                'wikiDataId' => 'Q668',
                'image' => NULL,
                'status' => 1
            ]
        ];

        DB::table('countries')->insert($countries);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Countries table seeded with India successfully!');
    }
}
