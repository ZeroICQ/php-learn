<?php

namespace AppTest\Geometry;


use App\Geometry\Circle;
use PHPUnit\Framework\TestCase;
use TestUtils\MathUtils;
use TestUtils\CoordUtils;

class CircleTest extends TestCase
{
    public function testArea()
    {
        $radius = 10;
        $circle = new Circle(0, 0, $radius);
        $actualArea = M_PI * pow($radius, 2);
        $this->assertEquals($actualArea, $circle->getArea());
    }

    public function testPerimeterRnd()
    {
        $radius = 10;
        $circle = new Circle(0, 0, $radius);
        $actualPerimeter = 2 * M_PI * $radius;
        $this->assertEquals($actualPerimeter, $circle->getPerimeter());
    }
}