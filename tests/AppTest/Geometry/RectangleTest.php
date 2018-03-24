<?php


namespace AppTest\Geometry;


use App\Geometry\Rectangle;
use PHPUnit\Framework\TestCase;
use TestUtils\CoordUtils;

class RectangleTest extends TestCase
{
    public function testLength()
    {
        $rectangle = new Rectangle(0, 0 , 10, 10);
        $this->assertEquals(10, $rectangle->getLength());
    }

    public function testWidth()
    {
        $rectangle = new Rectangle(0, 0 , 10, 10);
        $this->assertEquals(10, $rectangle->getLength());
    }

    public function testArea()
    {
        $rectangle = new Rectangle(0, 0 , 10, 10);
        $actualArea = 100;
        $this->assertEquals($actualArea, $rectangle->getArea());
    }

    public function testPerimeter()
    {
        $rectangle = new Rectangle(0, 0 , 10, 10);
        $actualPerimeter = 40;
        $this->assertEquals($actualPerimeter, $rectangle->getPerimeter());
    }
}