<?php


namespace AppTest\Geometry;


use App\Geometry\Circle;
use App\Geometry\GeometryUtils;
use App\Geometry\Point;
use App\Geometry\Segment;
use PHPUnit\Framework\TestCase;

class IntersectsTest extends TestCase
{
    /**
     * @dataProvider pointIntersectsPointProvider
     * @param array $point1Coords
     * @param array $point2Coords
     * @param bool $isIntersects
     */
    public function testIntersectsPoint(array $point1Coords, array $point2Coords, bool $isIntersects)
    {
        $p1 = new Point(...$point1Coords);
        $p2 = new Point(...$point2Coords);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($p1, $p2));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($p2, $p1));
    }

    /**
     * @dataProvider segmentIntersectsPointProvider
     * @param array $segmentC
     * @param array $pointC
     * @param $isIntersects
     */
    public function testSegmentIntersectsPoint(array $segmentC, array $pointC, $isIntersects)
    {
        $point = new Point(...$pointC);
        $segment = new Segment(...$segmentC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($point, $segment));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($segment, $point));
    }

    /**
     * @dataProvider segmentIntersectsSegmentProvider
     * @param array $segment1C
     * @param array $segment2C
     * @param bool $isIntersects
     */
    public function testSegmentIntersectsSegment(array $segment1C, array $segment2C, bool $isIntersects)
    {
        $segment1 = new Segment(...$segment1C);
        $segment2 = new Segment(...$segment2C);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($segment1, $segment2));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($segment2, $segment1));
    }

    /**
     * @dataProvider segmentIntersectsCircleProvider
     * @param array $segmentC
     * @param array $circleC
     * @param bool $isIntersects
     */
    public function testSegmentIntersectsCircle(array $segmentC, array $circleC, bool $isIntersects)
    {
        $segment = new Segment(...$segmentC);
        $circle = new Circle(...$circleC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($segment, $circle));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($circle, $segment));
    }

    /**
     * @return array
     */
    public function pointIntersectsPointProvider(): array
    {
        //[p1[x,y], p2[x,y], intersects]
        return [
            [[10, 10], [10, 10], true],//same
            [[-121, 21232], [10, 10], false],//different
        ];
    }

    /**
     * @return array
     */
    public function segmentIntersectsPointProvider(): array
    {
        //[segment1[x1,y1,x2,y2], p[x,y], intersects]
        return [
            [[0, 0, 10, 10], [5, 5], true],
            [[0, 0, 10, 10], [11, 11], false],
            [[0, 0, 10, 10], [1221, 1221], false],
        ];
    }

    /**
     * @return array
     */
    public function segmentIntersectsSegmentProvider(): array
    {
        //[segment1[x1,y1,x2,y2], segment2[x1,y1,x2,y2], intersects]
        return [
            [[0, 0, 10, 10], [10, 10, 10, 0], true], //intersect in the edge
            [[0, 0, 10, 0], [5, 10, 5, -10], true], // perpendicular
            [[0, 0, 10, 10], [0, -1, 10, 9], false], // parallel
            [[0, 0, 10, 10], [10.5, 10.5, 20, 20], false], //same line not intersect
            [[0, 0, 8, 1], [0, 10.1, 6, 0], true], //intersects
        ];
    }

    public function segmentIntersectsCircleProvider()
    {
        //[segment[x1,y1,x2,y2], circle[x1,y1,radius], intersects]
        return [
            [[0, 10, 10, 10], [0, 0, 10], false],//tangent
            [[7, 17, 9.5, 1], [4, 5, 4], false],//tangent
            [[2, 10, 7, -1], [4, 5, 4], true],//crossing
            [[4.5, 6.2, 6.7, 4.4], [4, 5, 4], false],//inside curce
        ];
    }
}