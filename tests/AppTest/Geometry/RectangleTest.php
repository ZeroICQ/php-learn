<?php


namespace AppTest\Geometry;


use App\Geometry\Rectangle;
use PHPUnit\Framework\TestCase;
use TestUtils\CoordUtils;

class RectangleTest extends TestCase
{
    /**
     * @dataProvider randomCoords
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function testLength(float $x1, float $y1, float $x2, float $y2)
    {
        $rectangle = new Rectangle($x1, $y1, $x2, $y2);
        $actualLength = abs($x1 - $x2);
        $this->assertEquals($actualLength, $rectangle->getLength());
    }

    /**
     * @dataProvider randomCoords
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function testWidth(float $x1, float $y1, float $x2, float $y2)
    {
        $rectangle = new Rectangle($x1, $y1, $x2, $y2);
        $actuaWidth = abs($y2 - $y1);
        $this->assertEquals($actuaWidth, $rectangle->getWidth());
    }

    /**
     * @dataProvider randomCoords
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function testArea(float $x1, float $y1, float $x2, float $y2)
    {
        $rectangle = new Rectangle($x1, $y1, $x2, $y2);
        $actualArea =  abs($x2 - $x1) * abs($y2 - $y1);
        $this->assertEquals($actualArea, $rectangle->getArea());
    }

    /**
     * @dataProvider randomCoords
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function testPerimeter(float $x1, float $y1, float $x2, float $y2)
    {
        $rectangle = new Rectangle($x1, $y1, $x2, $y2);
        $actualPerimeter = 2 * abs($x2 - $x1) + 2 * abs($y2 - $y1);
        $this->assertEquals($actualPerimeter, $rectangle->getPerimeter());
    }

    /**
     * @return array
     */
    public function randomCoords()
    {
        return CoordUtils::getArrayRandom2DCoords(4);
    }
}