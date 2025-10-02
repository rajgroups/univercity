<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubregionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Clear existing data
        DB::table('subregions')->truncate();
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $now = Carbon::now();
        $subregions = [
            [
                'id' => 1,
                'name' => 'Northern Africa',
                'translations' => json_encode([
                    "br" => "Afrika an North",
                    "ko" => "북아프리카",
                    "pt" => "Norte de África",
                    "nl" => "Noord-Afrika",
                    "hr" => "Sjeverna Afrika",
                    "fa" => "شمال آفریقا",
                    "de" => "Nordafrika",
                    "es" => "Norte de África",
                    "fr" => "Afrique du Nord",
                    "ja" => "北アフリカ",
                    "it" => "Nordafrica",
                    "zh-CN" => "北部非洲",
                    "ru" => "Северная Африка",
                    "uk" => "Північна Африка",
                    "pl" => "Afryka Północna"
                ]),
                'region_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27381'
            ],
            [
                'id' => 2,
                'name' => 'Middle Africa',
                'translations' => json_encode([
                    "br" => "Afrika ar C'hreiz",
                    "ko" => "중앙아프리카",
                    "pt" => "África Central",
                    "nl" => "Centraal-Afrika",
                    "hr" => "Srednja Afrika",
                    "fa" => "مرکز آفریقا",
                    "de" => "Zentralafrika",
                    "es" => "África Central",
                    "fr" => "Afrique centrale",
                    "ja" => "中部アフリ카",
                    "it" => "Africa centrale",
                    "zh-CN" => "中部非洲",
                    "ru" => "Средняя Африка",
                    "uk" => "Середня Африка",
                    "pl" => "Afryka Środkowa"
                ]),
                'region_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27433'
            ],
            [
                'id' => 3,
                'name' => 'Western Africa',
                'translations' => json_encode([
                    "br" => "Afrika ar C'hornaoueg",
                    "ko" => "서아프리카",
                    "pt" => "África Ocidental",
                    "nl" => "West-Afrika",
                    "hr" => "Zapadna Afrika",
                    "fa" => "غرب آفریقا",
                    "de" => "Westafrika",
                    "es" => "África Occidental",
                    "fr" => "Afrique de l'Ouest",
                    "ja" => "西アフリ카",
                    "it" => "Africa occidentale",
                    "zh-CN" => "西非",
                    "ru" => "Западная Африка",
                    "uk" => "Західна Африка",
                    "pl" => "Afryka Zachodnia"
                ]),
                'region_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q4412'
            ],
            [
                'id' => 4,
                'name' => 'Eastern Africa',
                'translations' => json_encode([
                    "br" => "Afrika ar Reter",
                    "ko" => "동아프리카",
                    "pt" => "África Oriental",
                    "nl" => "Oost-Afrika",
                    "hr" => "Istočna Afrika",
                    "fa" => "شرق آفریقا",
                    "de" => "Ostafrika",
                    "es" => "África Oriental",
                    "fr" => "Afrique de l'Est",
                    "ja" => "東アフリカ",
                    "it" => "Africa orientale",
                    "zh-CN" => "东部非洲",
                    "ru" => "Восточная Африка",
                    "uk" => "Східна Африка",
                    "pl" => "Afryka Wschodnia"
                ]),
                'region_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27407'
            ],
            [
                'id' => 5,
                'name' => 'Southern Africa',
                'translations' => json_encode([
                    "br" => "Suafrika",
                    "ko" => "남아프리카",
                    "pt" => "África Austral",
                    "nl" => "Zuidelijk Afrika",
                    "hr" => "Južna Afrika",
                    "fa" => "جنوب آفریقا",
                    "de" => "Südafrika",
                    "es" => "África austral",
                    "fr" => "Afrique australe",
                    "ja" => "南部アフリカ",
                    "it" => "Africa australe",
                    "zh-CN" => "南部非洲",
                    "ru" => "Южная Африка",
                    "uk" => "Південna Африка",
                    "pl" => "Afryka Południowa"
                ]),
                'region_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27394'
            ],
            [
                'id' => 6,
                'name' => 'Northern America',
                'translations' => json_encode([
                    "br" => "Norzhamerika",
                    "ko" => "북미",
                    "pt" => "América Setentrional",
                    "nl" => "Noord-Amerika",
                    "fa" => "شمال آمریکا",
                    "de" => "Nordamerika",
                    "es" => "América Norteña",
                    "fr" => "Amérique septentrionale",
                    "ja" => "北部アメリカ",
                    "it" => "America settentrionale",
                    "zh-CN" => "北美地區",
                    "ru" => "Северная Америка",
                    "uk" => "Північна Америка",
                    "pl" => "Ameryka Północna"
                ]),
                'region_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q2017699'
            ],
            [
                'id' => 7,
                'name' => 'Caribbean',
                'translations' => json_encode([
                    "br" => "Karib",
                    "ko" => "카리브",
                    "pt" => "Caraíbas",
                    "nl" => "Caraïben",
                    "hr" => "Karibi",
                    "fa" => "کارائیب",
                    "de" => "Karibik",
                    "es" => "Caribe",
                    "fr" => "Caraïbes",
                    "ja" => "カリブ海地域",
                    "it" => "Caraibi",
                    "zh-CN" => "加勒比地区",
                    "ru" => "Карибы",
                    "uk" => "Кариби",
                    "pl" => "Karaiby"
                ]),
                'region_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q664609'
            ],
            [
                'id' => 8,
                'name' => 'South America',
                'translations' => json_encode([
                    "br" => "Suamerika",
                    "ko" => "남아메리카",
                    "pt" => "América do Sul",
                    "nl" => "Zuid-Amerika",
                    "hr" => "Južna Amerika",
                    "fa" => "آمریکای جنوبی",
                    "de" => "Südamerika",
                    "es" => "América del Sur",
                    "fr" => "Amérique du Sud",
                    "ja" => "南アメリカ",
                    "it" => "America meridionale",
                    "zh-CN" => "南美洲",
                    "ru" => "Южная Америка",
                    "uk" => "Південна Америка",
                    "pl" => "Ameryka Południowa"
                ]),
                'region_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q18'
            ],
            [
                'id' => 9,
                'name' => 'Central America',
                'translations' => json_encode([
                    "br" => "Kreizamerika",
                    "ko" => "중앙아메리카",
                    "pt" => "América Central",
                    "nl" => "Centraal-Amerika",
                    "hr" => "Srednja Amerika",
                    "fa" => "آمریکای مرکزی",
                    "de" => "Zentralamerika",
                    'es' => "América Central",
                    "fr" => "Amérique centrale",
                    "ja" => "中央アメリカ",
                    "it" => "America centrale",
                    "zh-CN" => "中美洲",
                    "ru" => "Центральная Америка",
                    "uk" => "Центральна Америка",
                    "pl" => "Ameryka Środkowa"
                ]),
                'region_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27611'
            ],
            [
                'id' => 10,
                'name' => 'Central Asia',
                'translations' => json_encode([
                    "br" => "Azia ar C'hreiz",
                    "ko" => "중앙아시아",
                    "pt" => "Ásia Central",
                    "nl" => "Centraal-Azië",
                    "hr" => "Srednja Azija",
                    "fa" => "آسیای میانه",
                    "de" => "Zentralasien",
                    "es" => "Asia Central",
                    "fr" => "Asie centrale",
                    "ja" => "中央アジア",
                    "it" => "Asia centrale",
                    "zh-CN" => "中亚",
                    "ru" => "Центральная Азия",
                    "uk" => "Центральна Азія",
                    "pl" => "Azja Środkowa"
                ]),
                'region_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27275'
            ],
            [
                'id' => 11,
                'name' => 'Western Asia',
                'translations' => json_encode([
                    "br" => "Azia ar Mervent",
                    "ko" => "서아시아",
                    "pt" => "Sudoeste Asiático",
                    "nl" => "Zuidwest-Azië",
                    "hr" => "Jugozapadna Azija",
                    "fa" => "غرب آسیa",
                    "de" => "Vorderasien",
                    "es" => "Asia Occidental",
                    "fr" => "Asie de l'Ouest",
                    "ja" => "西アジア",
                    "it" => "Asia occidentale",
                    "zh-CN" => "西亚",
                    "ru" => "Западная Азия",
                    "uk" => "Західна Азія",
                    "pl" => "Azja Zachodnia"
                ]),
                'region_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27293'
            ],
            [
                'id' => 12,
                'name' => 'Eastern Asia',
                'translations' => json_encode([
                    "br" => "Azia ar Reter",
                    "ko" => "동아시아",
                    "pt" => "Ásia Oriental",
                    "nl" => "Oost-Azië",
                    "hr" => "Istočna Azija",
                    "fa" => "شرق آسیا",
                    "de" => "Ostasien",
                    "es" => "Asia Oriental",
                    "fr" => "Asie de l'Est",
                    "ja" => "東アジア",
                    "it" => "Asia orientale",
                    "zh-CN" => "東亞",
                    "ru" => "Восточная Азия",
                    "uk" => "Східна Азія",
                    "pl" => "Azja Wschodnia"
                ]),
                'region_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27231'
            ],
            [
                'id' => 13,
                'name' => 'South-Eastern Asia',
                'translations' => json_encode([
                    "br" => "Azia ar Gevred",
                    "ko" => "동남아시아",
                    "pt" => "Sudeste Asiático",
                    "nl" => "Zuidoost-Azië",
                    "hr" => "Jugoistočna Azija",
                    "fa" => "جنوب شرق آسیا",
                    "de" => "Südostasien",
                    "es" => "Sudeste Asiático",
                    "fr" => "Asie du Sud-Est",
                    "ja" => "東南アジア",
                    "it" => "Sud-est asiatico",
                    "zh-CN" => "东南亚",
                    "ru" => "Юго-Восточная Азия",
                    "uk" => "Південно-Східна Азія",
                    "pl" => "Azja Południowo-Wschodnia"
                ]),
                'region_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q11708'
            ],
            [
                'id' => 14,
                'name' => 'Southern Asia',
                'translations' => json_encode([
                    "br" => "Azia ar Su",
                    "ko" => "남아시아",
                    "pt" => "Ásia Meridional",
                    "nl" => "Zuid-Azië",
                    "hr" => "Južna Azija",
                    "fa" => "جنوب آسیا",
                    "de" => "Südasien",
                    "es" => "Asia del Sur",
                    "fr" => "Asie du Sud",
                    "ja" => "南アジア",
                    "it" => "Asia meridionale",
                    "zh-CN" => "南亚",
                    "ru" => "Южная Азия",
                    "uk" => "Південна Азія",
                    "pl" => "Azja Południowa"
                ]),
                'region_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q771405'
            ],
            [
                'id' => 15,
                'name' => 'Eastern Europe',
                'translations' => json_encode([
                    "br" => "Europa ar Reter",
                    "ko" => "동유럽",
                    "pt" => "Europa de Leste",
                    "nl" => "Oost-Europa",
                    "hr" => "Istočna Europa",
                    "fa" => "شرق اروپا",
                    "de" => "Osteuropa",
                    "es" => "Europa Oriental",
                    "fr" => "Europe de l'Est",
                    "ja" => "東ヨーロッパ",
                    "it" => "Europa orientale",
                    "zh-CN" => "东欧",
                    "ru" => "Восточная Европa",
                    "uk" => "Східна Європа",
                    "pl" => "Europa Wschodnia"
                ]),
                'region_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27468'
            ],
            [
                'id' => 16,
                'name' => 'Southern Europe',
                'translations' => json_encode([
                    "br" => "Europa ar Su",
                    "ko" => "남유럽",
                    "pt" => "Europa meridional",
                    "nl" => "Zuid-Europa",
                    "hr" => "Južna Europa",
                    "fa" => "جنوب اروپا",
                    "de" => "Südeuropa",
                    "es" => "Europa del Sur",
                    "fr" => "Europe du Sud",
                    "ja" => "南ヨーロッパ",
                    "it" => "Europa meridionale",
                    "zh-CN" => "南欧",
                    "ru" => "Южная Европа",
                    "uk" => "Південна Європа",
                    "pl" => "Europa Południowa"
                ]),
                'region_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27449'
            ],
            [
                'id' => 17,
                'name' => 'Western Europe',
                'translations' => json_encode([
                    "br" => "Europa ar C'hornaoueg",
                    "ko" => "서유럽",
                    "pt" => "Europa Ocidental",
                    "nl" => "West-Europa",
                    "hr" => "Zapadna Europa",
                    "fa" => "غرب اروپا",
                    "de" => "Westeuropa",
                    "es" => "Europa Occidental",
                    "fr" => "Europe de l'Ouest",
                    "ja" => "西ヨーロッパ",
                    "it" => "Europa occidentale",
                    "zh-CN" => "西欧",
                    "ru" => "Западная Европа",
                    "uk" => "Західна Європa",
                    "pl" => "Europa Zachodnia"
                ]),
                'region_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27496'
            ],
            [
                'id' => 18,
                'name' => 'Northern Europe',
                'translations' => json_encode([
                    "br" => "Europa an North",
                    "ko" => "북유럽",
                    "pt" => "Europa Setentrional",
                    "nl" => "Noord-Europa",
                    "hr" => "Sjeverna Europa",
                    "fa" => "شمال اروپا",
                    "de" => "Nordeuropa",
                    "es" => "Europa del Norte",
                    "fr" => "Europe du Nord",
                    "ja" => "北ヨーロッパ",
                    "it" => "Europa settentrionale",
                    "zh-CN" => "北歐",
                    "ru" => "Северная Европа",
                    "uk" => "Північна Європа",
                    "pl" => "Europa Północna"
                ]),
                'region_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q27479'
            ],
            [
                'id' => 19,
                'name' => 'Australia and New Zealand',
                'translations' => json_encode([
                    "br" => "Aostralia ha Zeland-Nevez",
                    "ko" => "오스트랄라시아",
                    "pt" => "Australásia",
                    "nl" => "Australazië",
                    "hr" => "Australazija",
                    "fa" => "استرالزی",
                    "de" => "Australasien",
                    "es" => "Australasia",
                    "fr" => "Australasie",
                    "ja" => "オーストララシア",
                    "it" => "Australasia",
                    "zh-CN" => "澳大拉西亞",
                    "ru" => "Австралия и Новая Зеландия",
                    "uk" => "Австралія та Нова Зеландія",
                    "pl" => "Australia i Nowa Zelandia"
                ]),
                'region_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q45256'
            ],
            [
                'id' => 20,
                'name' => 'Melanesia',
                'translations' => json_encode([
                    "br" => "Melanezia",
                    "ko" => "멜라네시아",
                    "pt" => "Melanésia",
                    "nl" => "Melanesië",
                    "hr" => "Melanezija",
                    "fa" => "ملانزی",
                    "de" => "Melanesien",
                    "es" => "Melanesia",
                    "fr" => "Mélanésie",
                    "ja" => "メラнеシア",
                    "it" => "Melanesia",
                    "zh-CN" => "美拉尼西亚",
                    "ru" => "Меланезия",
                    "uk" => "Меланезія",
                    "pl" => "Melanezja"
                ]),
                'region_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q37394'
            ],
            [
                'id' => 21,
                'name' => 'Micronesia',
                'translations' => json_encode([
                    "br" => "Mikronezia",
                    "ko" => "미크로네시아",
                    "pt" => "Micronésia",
                    "nl" => "Micronesië",
                    "hr" => "Mikronezija",
                    "fa" => "میکرونزی",
                    "de" => "Mikronesien",
                    "es" => "Micronesia",
                    "fr" => "Micronésie",
                    "ja" => "ミクロネシア",
                    "it" => "Micronesia",
                    "zh-CN" => "密克罗尼西亚群岛",
                    "ru" => "Микронезия",
                    "uk" => "Мікронезія",
                    "pl" => "Mikronezja"
                ]),
                'region_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q3359409'
            ],
            [
                'id' => 22,
                'name' => 'Polynesia',
                'translations' => json_encode([
                    "br" => "Polisezia",
                    "ko" => "폴리네시아",
                    "pt" => "Polinésia",
                    "nl" => "Polynesië",
                    "hr" => "Polinezija",
                    "fa" => "پلی‌نزی",
                    "de" => "Polynesien",
                    "es" => "Polinesia",
                    "fr" => "Polynésie",
                    "ja" => "ポリネシア",
                    "it" => "Polinesia",
                    "zh-CN" => "玻里尼西亞",
                    "ru" => "Полинезия",
                    "uk" => "Полінезія",
                    "pl" => "Polinezja"
                ]),
                'region_id' => 5,
                'created_at' => $now,
                'updated_at' => $now,

                'wikidataid' => 'Q35942'
            ]
        ];

        DB::table('subregions')->insert($subregions);
    }
}
