<?php


namespace AppTest\Geometry;


use App\Geometry\GeometryUtils;
use App\Geometry\Point;
use App\Geometry\Segment;
use PHPUnit\Framework\TestCase;

class ContainsTest extends TestCase
{
    /**
     * @dataProvider pointContainsPointProvider
     * @param array $coords
     * @param bool $isContains
     */
    public function testPointContainsPoint(array $coords, bool $isContains)
    {
        $p1 = new Point($coords[0], $coords[1]);
        $p2 = new Point($coords[2], $coords[3]);

        $this->assertEquals($isContains, GeometryUtils::isContains($p2, $p1));
        $this->assertEquals($isContains, GeometryUtils::isContains($p1, $p2));
    }

    /**
     * @dataProvider segmentContainsPointProvider
     * @param $segmentCoords
     * @param $pointCoords
     * @param $isContains
     */
    public function testSegmentContainsPoint($segmentCoords, $pointCoords, $isContains)
    {
        $segment = new Segment(...$segmentCoords);
        $point = new Point(...$pointCoords);

        $this->assertEquals($isContains, GeometryUtils::isContains($segment, $point));
        $this->assertEquals($isContains, GeometryUtils::isContains($point, $segment));
    }

    /**
     * @return array
     */
    public function pointContainsPointProvider(): array
    {
        return [
            [[10, 10, 10, 10], true], //same points
            [[100, 100, -10, -10], false] //different point
        ];
    }

    /**
     * @return array
     */
    public function segmentContainsPointProvider(): array
    {
        //[segment[x1,y1,x2,y2], point[x,y], contain]
        return [
            [[0, 0, 10, 10], [5, 5], true],
            [[0, 0, 10, 10], [-5, -5], false], //same line but not in segment
            [[0, 10, 15, 10], [8, 5], false]
        ];
    }

}
