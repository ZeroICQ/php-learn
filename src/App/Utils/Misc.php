<?php


namespace App\Utils;

use App\Geometry\GeometryUtils;

class Misc
{
    /**
     * @param $a
     * @param $b
     */
    public static function swap(&$a, &$b)
    {
        $tmp = $a;
        $a = $b;
        $b = $tmp;
    }

    /**
     * @param float $number
     * @return int
     */
    public static function sign(float $number): int
    {
        if (abs($number) < GeometryUtils::EPS) {
            return 0;
        }

        return $number > 0 ? 1 : -1;
    }
}
