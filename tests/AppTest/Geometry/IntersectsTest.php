<?php


namespace AppTest\Geometry;


use App\Geometry\Circle;
use App\Geometry\GeometryUtils;
use App\Geometry\Point;
use App\Geometry\Rectangle;
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
     * @dataProvider pointIntersectsCircleProvider
     * @param array $pointC
     * @param array $circleC
     * @param bool $isIntersects
     */
    public function testPointIntersectsCircle(array $pointC, array $circleC, bool $isIntersects)
    {
        $point = new Point(...$pointC);
        $circle = new Circle(...$circleC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($point, $circle));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($circle, $point));
    }

    /**
     * @dataProvider circleIntersectsCircleProvider
     * @param array $circle1C
     * @param array $circle2C
     * @param bool $isIntersects
     */
    public function testCircleIntersectsCircle(array $circle1C, array $circle2C, bool $isIntersects)
    {
        $circle1 = new Circle(...$circle1C);
        $circle2 = new Circle(...$circle2C);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($circle1, $circle2));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($circle2, $circle1));
    }

    /**
     * @dataProvider rectangleIntersectsPointProvider
     * @param array $rectC
     * @param array $pointC
     * @param bool $isIntersects
     */
    public function testRectangleIntersectsPoint(array $rectC, array $pointC, bool $isIntersects)
    {
        $rect = new Rectangle(...$rectC);
        $point = new Point(...$pointC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($rect, $point));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($point, $rect));
    }

    /**
     * @dataProvider rectangleIntersectsSegmentProvider
     * @param array $rectC
     * @param array $segmentC
     * @param bool $isIntersects
     */
    public function testRectangleIntersectsSegment(array $rectC, array $segmentC, bool $isIntersects)
    {
        $rect = new Rectangle(...$rectC);
        $segment = new Segment(...$segmentC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($rect, $segment));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($segment, $rect));
    }

    /**
     * @dataProvider rectangleIntersectsRectangleProvider
     * @param array $rect1C
     * @param array $rect2C
     * @param bool $isIntersects
     */
    public function testRectangleIntersectsRectangle(array $rect1C, array $rect2C, bool $isIntersects)
    {
        $rect1 = new Rectangle(...$rect1C);
        $rect2 = new Rectangle(...$rect2C);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($rect1, $rect2));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($rect2, $rect1));
    }

    /**
     * @dataProvider rectangleIntersectsCircleProvider
     * @param array $rectC
     * @param array $circleC
     * @param bool $isIntersects
     */
    public function testRectangleIntersectsCircle(array $rectC, array $circleC, bool $isIntersects)
    {
        $rect = new Rectangle(...$rectC);
        $circle = new Circle(...$circleC);

        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($rect, $circle));
        $this->assertEquals($isIntersects, GeometryUtils::isIntersects($circle, $rect));
    }

    public function testWrongShape()
    {
        $stub = $this->createMock(Circle::class);

        $stub->method('getName')
            ->willReturn('no such shape');
        $this->assertEquals(false, GeometryUtils::isIntersects($stub, $stub));
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

    public function segmentIntersectsCircleProvider(): array 
    {
        //[segment[x1,y1,x2,y2], circle[x1,y1,radius], intersects]
        return [
            [[0, 10, 10, 10], [0, 0, 10], false],//tangent
            [[7, 17, 9.5, 1], [4, 5, 4], false],//tangent
            [[2, 10, 7, -1], [4, 5, 4], true],//crossing
            [[4.5, 6.2, 6.7, 4.4], [4, 5, 4], false],//inside circle
            [[5.9, 7.5, 4, 9.5], [4, 5, 4], true],//one end inside circle
            [[5, 6, 4, 1], [4, 5, 4], true],//one on circle
            [[0, 0, 0, 10], [-1, 5, 1000], false],//inside vertical
        ];
    }

    public function pointIntersectsCircleProvider(): array 
    {
        //[point[x1,y1], circle[x1,y1,radius], intersects]
        return [
            [[6, 7], [3, 7, 3], true],
            [[80, 7], [3, 7, 3], false],//outside
            [[4, 7], [3, 7, 3], false],//inside
        ];
    }

    public function circleIntersectsCircleProvider(): array
    {
        //[circle2[x1,y1,radius], circle2[x1,y1,radius], intersects]
        return [
            [[4, 6, 3.2], [4, -1, 3.8], false],//tangent
            [[4, 6, 4], [4, -1, 3.8], true],//intersects
            [[2.7, 5.7, 1.6], [4, -1, 3.8], false],//inside
            [[2.7, 5.7, 1.8], [4, -1, 3.8], false],//inside tangents
        ];
    }

    /**
     * @return array
     */
    public function rectangleIntersectsPointProvider(): array
    {
        //[rectangle[x1,y1,x2,y2], point[x1,y1], intersects]
        return [
            [[0, 10, 10, 0], [5, 10], true],//intersects
            [[0, 10, 10, 0], [5, 5], false],//inside
            [[0, 10, 10, 0], [100, 100], false],//outside
            [[0, 10, 10, 0], [0, 10], true],//corner
        ];
    }

    /**
     * @return array
     */
    public function rectangleIntersectsSegmentProvider(): array
    {
        //[rectangle[x1,y1,x2,y2], segment[x1,y1,x2,y2], intersects]
        return [
            [[1, 11, 9, -3], [4, 12, -1, 9], true],
            [[1, 11, 9, -3], [7, 13, 13, 7], true],//corner
            [[1, 11, 9, -3], [2, 10, 8, -1.5], false],//inside
            [[1, 11, 9, -3], [-3, 12, 0, 6], false],//outside
            [[1, 11, 9, -3], [9, 11, 1, -3], true],//diagonal
        ];
    }

    public function rectangleIntersectsRectangleProvider()
    {
        //[rectangle1[x1,y1,x2,y2], rectangle1[x1,y1,x2,y2], intersects]
        return [
            [[1, 11, 9, -3], [2, 10, 8, -1.5], false],//inside
            [[1, 11, 9, -3], [4, 12, -1, 9], true],
            [[1, 11, 9, -3], [0, 9, 4, 4], true],
            [[1, 11, 9, -3], [10.3, 12.22 , 9, 11], true],//corner
            [[1, 11, 9, -3], [10.3, 12.22 , 9, 11], true],//corner
            [[1, 11, 9, -3], [-3, 12, 0, 6], false],//outside
        ];
    }

    public function rectangleIntersectsCircleProvider()
    {
        //[rectangle1[x1,y1,x2,y2], circle[x1,y1,radius], intersects]
        return [
            [[1, 10, 8, -1], [4, 5, 3], false],//inside tangent
            [[0, 0, 10, 10], [-1, 5, 8.4], true],//inscribed
            [[0, 0, 10, 10], [-1, 5, 1000], false],//rect inside circle
            [[2, 12, 12, -4], [16, 14, 4.5], true],//inscribed
        ];
    }
}