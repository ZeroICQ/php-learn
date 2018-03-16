<?php
//TODO: add contains tests for other shapes

namespace AppTest\Geometry;


use App\Geometry\Point;
use PHPUnit\Framework\TestCase;
use TestUtils\CoordUtils;
use TestUtils\MathUtils;

class PointTest extends TestCase
{
    public function testGetDistanceRnd()
    {
        $p1 = new Point(3, 4);
        $p2 = new Point(0, 0);
        $this->assertEquals(5, $p1->distance($p2));
    }

    /**
     * @dataProvider rndCoordsProvider
     * @param float $x
     * @param float $y
     */
    public function testEqualToRnd(float $x, float $y)
    {
        $p1 = new Point($x, $y);
        $p2 = new Point($x, $y);

        $this->assertTrue($p1->isEqualTo($p2));
        $this->assertTrue($p2->isEqualTo($p1));
    }

    /**
     * @dataProvider rndCoordsProvider
     * @param float $x
     * @param float $y
     */
    public function testSettersRnd(float $x, float $y)
    {
        $p = new Point($x, $y);
        $x = MathUtils::randomFloat();
        $y = MathUtils::randomFloat();

        $p->setX($x);
        $p->setY($y);

        $this->assertEquals($x, $p->getX());
        $this->assertEquals($y, $p->getY());
    }

    /**
     * @dataProvider rndCoordsProvider
     * @param float $x
     * @param float $y
     */
    public function testAreaRnd(float $x, float $y)
    {
        $p = new Point($x, $y);
        $this->assertEquals(0,$p->getArea());
    }

    /**
     * @dataProvider rndCoordsProvider
     * @param float $x
     * @param float $y
     */
    public function testPerimeterRnd(float $x, float $y)
    {
        $p = new Point($x, $y);
        $this->assertEquals(0,$p->getPerimeter());
    }

    /**
     * @dataProvider  rndCoordsProvider
     * @param $x
     * @param $y
     */
    public function testContainsEqualRnd($x, $y)
    {
        $p1 = new Point($x, $y);
        $p2 = new Point($x, $y);
        $this->assertTrue($p1->isContains($p2));
        $this->assertTrue($p2->isContains($p1));
    }

    /**
     * @dataProvider  rndCoordsProvider
     * @param $x
     * @param $y
     */
    public function testContainsNotEqualRnd($x, $y)
    {
        $p1 = new Point($x, $y);
        $p2 = new Point($x-0.001, $y-1);
        $this->assertFalse($p1->isContains($p2));
        $this->assertFalse($p2->isContains($p1));
    }

    public function rndCoordsProvider()
    {
        return CoordUtils::getArrayRandom2DCoords();
    }

}