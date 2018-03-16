<?php

namespace AppTest\Geometry;


use App\Geometry\Circle;
use PHPUnit\Framework\TestCase;
use TestUtils\MathUtils;
use TestUtils\CoordUtils;

class CircleTest extends TestCase
{

    /**
     * @dataProvider rndCoordsProvider
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
     * @dataProvider rndCoordsProvider
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
    public function rndCoordsProvider(): array
    {
        $radiusMax = 10000;
        $radiusMin = 0;

        $vector = CoordUtils::getArrayRandom2DCoords();
        array_walk($vector, function(&$coords) use ($radiusMin, $radiusMax) {
            array_push($coords, MathUtils::randomFloat($radiusMin, $radiusMax));
        });

        return $vector;
    }
}