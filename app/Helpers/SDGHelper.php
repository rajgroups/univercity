<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class SDGHelper
{
    public static function getAllSDGs()
    {
        $sdgsJson = Storage::disk('local')->get('sdgs.json');
        $sdgsData = json_decode($sdgsJson, true);

        return $sdgsData['sdgs'] ?? [];
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
}
