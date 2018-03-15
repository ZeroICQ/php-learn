<?php


namespace TestUtils;


class MathUtils
{
    private function __construct(){}

    /**
     * @param float $min
     * @param float $max
     * @return float
     */
    static public function randomFloat(float $min = 0, float $max = 1): float
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

}