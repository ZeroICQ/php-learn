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
     * @param array $segmentCoords
     * @param array $pointCoords
     * @param bool $isContains
     * @return array
     */
    public function testSegmentContainsPoint(array $segmentCoords, array $pointCoords, bool $isContains)
    {
        $segment = new Segment(...$segmentCoords);
        $point = new Point(...$pointCoords);

        $this->assertEquals($isContains, GeometryUtils::isContains($segment, $point));
        $this->assertEquals($isContains, GeometryUtils::isContains($point, $segment));
    }

    /**
     * @dataProvider segmentContainsSegmentProvider
     * @param array $segment1Coords
     * @param array $segment2Coords
     * @param bool $isContains
     */
    public function testSegmentContainsSegment(array $segment1Coords, array $segment2Coords, bool $isContains)
    {
        $segment1 = new Segment(...$segment1Coords);
        $segment2 = new Segment(...$segment2Coords);

        $this->assertEquals($isContains, GeometryUtils::isContains($segment1, $segment2));
        $this->assertEquals($isContains, GeometryUtils::isContains($segment2, $segment1));
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

    /**
     * @return array
     */
    public function segmentContainsSegmentProvider(): array
    {
        //[segment1[x1,y1,x2,y2], [segment1[x1,y1,x2,y2], contain]
        return [
            [[1, 2, 3, 4], [1, 2, 3, 4], true], //same
            [[0, 0, 0, 10], [-5, 5, 5, 5], false], //different
            [[0, 0, 5, 5], [0, 0, 10, 10], false], // same line but different length
        ];
    }

}
