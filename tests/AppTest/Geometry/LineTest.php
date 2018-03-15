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



    public function randomCoords()
    {
        $min = -5000;
        $max = 1000;
        $amount = 50;

        $vector = new SplFixedArray($amount);

        foreach ($vector as $index => $item) {
            $vector[$index] = new SplFixedArray(4);

            foreach ($vector[$index] as $j => $value) {
                $vector[$index][$j] = MathUtils::randomFloat($min, $max);
            }
            $vector[$index] = $vector[$index]->toArray();
        }
        return $vector->toArray();

    }
}