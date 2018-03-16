<?php


namespace AppTest\AppTest\Geometry;


use App\Geometry\Line;
use PHPUnit\Framework\TestCase;
use SplFixedArray;
use TestUtils\MathUtils;

class LineTest extends TestCase
{
    /**
     * @dataProvider randomCoords
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function testPerimeterRnd(float $x1, float $y1, float $x2, float $y2)
    {
        $line = new Line($x1, $y1, $x2, $y2);
        $actualLength = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
        $this->assertEquals($actualLength, $line->getPerimeter());
    }

    /**
     * @dataProvider randomCoords
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     */
    public function testAreaRnd($x1, $y1, $x2, $y2)
    {
        $line = new Line($x1, $y1, $x2, $y2);
        $this->assertEquals(0, $line->getArea());
    }


    /**
     * @return array
     */
    public function randomCoords()
    {
        $min = -50000;
        $max = 50000;
        $amount = 20;
        $coords = 4;
        $vector = [];

        for ($i = 0; $i < $amount; $i++) {
            $vector[$i] = [];

            for ($j = 0; $j < $coords; $j++) {
                $vector[$i][$j] = MathUtils::randomFloat($min, $max);
            }
        }
        return $vector;
    }
}