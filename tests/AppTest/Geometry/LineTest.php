<?php


namespace AppTest\AppTest\Geometry;


use App\Geometry\Line;
use App\Geometry\Point;
use PHPUnit\Framework\TestCase;
use TestUtils\MathUtils;
use TestUtils\CoordUtils;

class LineTest extends TestCase
{
    /**
     * @dataProvider rndCoordsProvider
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
     * @dataProvider rndCoordsProvider
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
     * @dataProvider rndCoordsProvider
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     */
    public function testContainsPointAtEndsRnd($x1, $y1, $x2, $y2)
    {
        $line = new Line($x1, $y1, $x2, $y2);
        $p1 = new Point($x1, $y1);
        $p2 = new Point($x2, $y2);

        $this->assertTrue($line->isContains($p1));
        $this->assertTrue($line->isContains($p2));
    }

    /**
     * @dataProvider rndCoordsProvider
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     */
    public function testContainsPointNot($x1, $y1, $x2, $y2)
    {
        $line = new Line(0, 0, 23, 23);
        $p1 = new Point(1,0.1);

        $this->assertFalse($line->isContains($p1));
    }

    public  function provider(): array
    {
        return [
            [[0, 0, 23, 23], [1, 0.1], false], //

        ];
    }


    /**
     * @return array
     */
    public function rndCoordsProvider(): array
    {
        return CoordUtils::getArrayRandom2DCoords(4);
    }
}