<?php


namespace AppTest\Geometry;


use App\Geometry\Circle;
use App\Geometry\GeometryUtils;
use App\Geometry\Point;
use App\Geometry\Segment;
use PHPUnit\Framework\TestCase;

class ContainsTest extends TestCase
{
    /**
     * @dataProvider pointContainsPointProvider
     * @param array $p1C
     * @param array $p2C
     * @param bool $isContains
     */
    public function testPointContainsPoint(array $p1C, array $p2C, bool $isContains)
    {
        $p1 = new Point(...$p1C);
        $p2 = new Point(...$p2C);

        $this->assertEquals($isContains, GeometryUtils::isContains($p1, $p2));
    }

    public function testPointContainsSegment()
    {
        $point = new Point(10, 10);
        $segment = new Segment(1, 2, 3, 4);

        $this->assertFalse(GeometryUtils::isContains($point, $segment));
    }

    /**
     * @dataProvider segmentContainsPointProvider
     * @param array $segmentCoords
     * @param array $pointCoords
     * @param bool $isContains
     */
    public function testSegmentContainsPoint(array $segmentCoords, array $pointCoords, bool $isContains)
    {
        $segment = new Segment(...$segmentCoords);
        $point = new Point(...$pointCoords);

        $this->assertEquals($isContains, GeometryUtils::isContains($segment, $point));
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
    }

    /**
     * @dataProvider circleContainsPointProvider
     * @param array $circleC
     * @param array $pointC
     * @param $isContains
     */
    public function testCircleContainsPoint(array $circleC, array $pointC, bool $isContains)
    {
        $circle = new Circle(...$circleC);
        $point = new Point(...$pointC);

        $this->assertEquals($isContains, GeometryUtils::isContains($circle, $point));
    }

    /**
     * @dataProvider circleContainsSegmentProvider
     * @param array $circleC
     * @param array $segmentC
     * @param bool $isContains
     */
    public function testCircleContainsSegment(array $circleC, array $segmentC, bool $isContains)
    {
        $circle = new Circle(...$circleC);
        $segment = new Segment(...$segmentC);

        $this->assertEquals($isContains, GeometryUtils::isContains($circle, $segment));
    }

    /**
     * @return array
     */
    public function pointContainsPointProvider(): array
    {
        //[p1[x,y], p2[x,y, intersects]
        return [
            [[10, 10], [10, 10], true], //same points
            [[100, 100], [-10, -10], false] //different point
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
        //[segment1[x1,y1,x2,y2], segment1[x1,y1,x2,y2], contain]
        return [
            [[1, 2, 3, 4], [1, 2, 3, 4], true], //same
            [[0, 0, 0, 10], [-5, 5, 5, 5], false], //different
            [[0, 0, 5, 5], [0, 0, 10, 10], false], // same line but different length
        ];
    }

    /**
     * @return array
     */
    public function circleContainsPointProvider(): array
    {
        //[circle[x1,y1,radius], p[x1,y1], contains]
        return [
            [[18, 12, 6], [11.9, 12], false], //tangent
            [[16, 14, 4.5], [13, 13], true], //contains
            [[16, 14, 4.5], [200, 200], false], //not contains
        ];
    }

    public function circleContainsSegmentProvider()
    {
        //[circle[x1,y1,radius], segment[x1,y1,x2,y2], contains]
        return [
            [[18, 12, 6], [24, 20, 24, 6], false], //tangent
            [[18, 12, 6], [18, 20, 18, 6], false], //one end out
            [[18, 12, 6], [8, 20, 26, 6], false], //cross
            [[18, 12, 6], [16, 16, 22, 12], true], //inside
            [[18, 12, 6], [12, 12, 20, 12], true], //one end on circle
        ];
    }

}
