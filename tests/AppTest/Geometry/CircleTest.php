<?php

namespace AppTest\Geometry;


use App\Geometry\Circle;
use PHPUnit\Framework\TestCase;
use TestUtils\MathUtils;

class CircleTest extends TestCase
{

    /**
     * @dataProvider randomCoords
     * @param float $x
     * @param float $y
     * @param float $radius
     */
    public function testAreaRnd(float $x, float $y, float $radius)
    {
        $circle = new Circle($x, $y, $radius);
        $actualArea = M_PI * pow($radius, 2);
        $this->assertEquals($actualArea, $circle->getArea());
    }

    /**
     * @dataProvider randomCoords
     * @param float $x
     * @param float $y
     * @param float $radius
     */
    public function testPerimeterRnd(float $x, float $y, float $radius)
    {
        $circle = new Circle($x, $y, $radius);
        $actualPerimeter = 2 * M_PI * $radius;
        $this->assertEquals($actualPerimeter, $circle->getPerimeter());
    }

    /**
     * @return array
     */
    public function randomCoords()
    {
        $min = -50000;
        $max = 50000;
        $amount = 20;
        $coords = 2;
        $radiusMax = 10000;
        $radiusMin = 0;

        $vector = [];

        for ($i = 0; $i < $amount; $i++) {
            $vector[$i] = [];

            for ($j = 0; $j < $coords; $j++) {
                $vector[$i][$j] = MathUtils::randomFloat($min, $max);
            }

            $vector[$i][$coords] = MathUtils::randomFloat($radiusMin, $radiusMax);
        }
        return $vector;
    }
}