<?php


namespace AppTest\Geometry;


use PHPUnit\Framework\TestCase;

class IntersectsTest extends TestCase
{
    /**
     * @dataProvider containsPointProvider
     * @param array $coords
     * @param bool $isIntersects
     */
    public function testIntersectsPoint(array $coords, bool $isIntersects)
    {
        $p1 = new Point($coords[0], $coords[1]);
        $p2 = new Point($coords[2], $coords[3]);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($p2, $p1));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($p1, $p2));
    }
}