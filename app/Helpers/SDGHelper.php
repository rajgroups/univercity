<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class SDGHelper
{
    // SDG official colors (for fallback icons)
    private static $sdgColors = [
        1 => 'E5243B', 2 => 'DDA63A', 3 => '4C9F38', 4 => 'C5192D', 5 => 'FF3A21',
        6 => '26BDE2', 7 => 'FCC30B', 8 => 'A21942', 9 => 'FD6925', 10 => 'DD1367',
        11 => 'FD9D24', 12 => 'BF8B2E', 13 => '3F7E44', 14 => '0A97D9', 15 => '56C02B',
        16 => '00689D', 17 => '19486A'
    ];

    // Multiple CDN sources for redundancy
    private static $iconSources = [
        'un_primary' => 'https://sdgs.un.org/themes/custom/porto/assets/goals/{id}.png',
        'un_alternative' => 'https://unstats.un.org/sdgs/report/2021/images/sdg{id}.png',
        'placeholder' => 'https://via.placeholder.com/150/{color}/FFFFFF?text=SDG+{id}',
        'ui_avatar' => 'https://ui-avatars.com/api/?name=SDG+{id}&background={color}&color=fff&size=150&bold=true',
        'dummyimage' => 'https://dummyimage.com/150x150/{color}/ffffff&text=SDG+{id}'
    ];

    public static function getAllSDGs()
    {
        $sdgsJson = Storage::disk('local')->get('sdgs.json');
        $sdgsData = json_decode($sdgsJson, true);

        $sdgs = $sdgsData['sdgs'] ?? [];

        // Enhance SDGs with image URLs
        foreach ($sdgs as &$sdg) {
            $sdg['image_url'] = self::getSDGImageUrl($sdg['id']);
            $sdg['color'] = self::$sdgColors[$sdg['id']] ?? '4C9F38';
        }

        return $sdgs;
    }

    public static function getSDGById($id)
    {
        $sdgs = self::getAllSDGs();

        foreach ($sdgs as $sdg) {
            if ($sdg['id'] == $id) {
                return $sdg;
            }
        }

        return null;
    }

    public static function getSDGsByIds(array $ids)
    {
        $sdgs = self::getAllSDGs();
        $filteredSDGs = [];

        foreach ($sdgs as $sdg) {
            if (in_array($sdg['id'], $ids)) {
                $filteredSDGs[] = $sdg;
            }
        }

        return $filteredSDGs;
    }

    public static function getSDGImageUrl($id, $source = 'un_primary')
    {
        $color = self::$sdgColors[$id] ?? '4C9F38';

        $sources = [
            'un_primary' => self::$iconSources['un_primary'],
            'un_alternative' => self::$iconSources['un_alternative'],
            'ui_avatar' => self::$iconSources['ui_avatar']
        ];

        $url = $sources[$source] ?? self::$iconSources['un_primary'];

        return str_replace(['{id}', '{color}'], [$id, $color], $url);
    }

    public static function getSDGColor($id)
    {
        return self::$sdgColors[$id] ?? '4C9F38';
    }
}
