<?php


namespace TestUtils;


class CoordUtils
{
    //static class
    private function __construct() {}

    /**
     * @param float $min
     * @param float $max
     * @return array
     */
    public static function getRandom2DCoords(float $min=-50000, float $max=50000): array
    {
        $coords = 2;
        $vector = [];

        for ($i = 0; $i < $coords; $i++) {
            array_push($vector, MathUtils::randomFloat($min, $max));
        }
        return $vector;
    }

    public static function getArrayRandom2DCoords(
        int $size=2,
        float $min=-50000,
        float $max=50000,
        int $amount=10
    ): array {
        $vector = [];
        for ($i = 0; $i < $amount; $i++) {
            $vector[$i] = [];

            for ($j = 0; $j < $size; $j++) {
                array_push($vector[$i], MathUtils::randomFloat($min, $max));
            }
        }
        return $vector;
    }
}