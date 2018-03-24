<?php


namespace AppTest\Geometry;


use App\Geometry\Circle;
use App\Geometry\GeometryUtils;
use App\Geometry\Point;
use App\Geometry\Rectangle;
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
     * @dataProvider circleContainsCircleProvider
     * @param array $circle1C
     * @param array $circle2C
     * @param bool $isContains
     */
    public function testCircleContainsCircle(array $circle1C, array $circle2C, bool $isContains)
    {
        $circle1 = new Circle(...$circle1C);
        $circle2 = new Circle(...$circle2C);

        $this->assertEquals($isContains, GeometryUtils::isContains($circle1, $circle2));
    }

    /**
     * @dataProvider circleContainsRectangleProvider
     * @param array $circleC
     * @param array $rectC
     * @param bool $isContains
     */
    public function testCircleContainsRectangle(array $circleC, array $rectC, bool $isContains)
    {
        $circle = new Circle(...$circleC);
        $rect = new Rectangle(...$rectC);

        $this->assertEquals($isContains, GeometryUtils::isContains($circle, $rect));
    }

    /**
     * @dataProvider rectangleContainsPointProvider
     * @param array $rectC
     * @param array $pointC
     * @param bool $isContains
     */
    public function testRectangleContainsPoint(array $rectC, array $pointC, bool $isContains)
    {
        $rect = new Rectangle(...$rectC);
        $point = new Point(...$pointC);

        $this->assertEquals($isContains, GeometryUtils::isContains($rect, $point));
    }

    /**
     * @dataProvider rectangleContainsSegmentProvider
     * @param array $rectC
     * @param array $segmentC
     * @param bool $isContains
     */
    public function testRectangleContainsSegment(array $rectC, array $segmentC, bool $isContains)
    {
        $rect = new Rectangle(...$rectC);
        $segment = new Segment(...$segmentC);

        $this->assertEquals($isContains, GeometryUtils::isContains($rect, $segment));
    }

    /**
     * @dataProvider rectangleContainsCircleProvider
     * @param array $rectC
     * @param array $circleC
     * @param bool $isContains
     */
    public function testRectangleContainsCircle(array $rectC, array $circleC, bool $isContains)
    {
        $rect = new Rectangle(...$rectC);
        $circle = new Circle(...$circleC);

        $this->assertEquals($isContains, GeometryUtils::isContains($rect, $circle));
    }


    /**
     * @dataProvider rectangleContainsRectangleProvider
     * @param array $rect1C
     * @param array $rect2C
     * @param bool $isContains
     */
    public function testRectangleContainsRectangle(array $rect1C, array $rect2C, bool $isContains)
    {
        $rect1 = new Rectangle(...$rect1C);
        $rect2 = new Rectangle(...$rect2C);

        $this->assertEquals($isContains, GeometryUtils::isContains($rect1, $rect2));
    }

    public function testWrongShape()
    {
        $stub = $this->createMock(Circle::class);

        $stub->method('getName')
            ->willReturn('no such shape');
        $this->assertEquals(false, GeometryUtils::isContains($stub, $stub));

        $segment= new Segment(0, 0, 1, 1);
        $this->assertEquals(false, GeometryUtils::isContains($segment, $stub));
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

    /**
     * @return array
     */
    public function circleContainsSegmentProvider(): array
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

    /**
     * @return array
     */
    public function circleContainsCircleProvider(): array
    {
        //[circle1[x1,y1,radius], circle2[x1,y1,radius], , contains]
        return [
            [[6, 4, 4], [6, 6, 1.4], true],//inside
            [[6, 6, 1.4], [3, 8, 4.1],  false],//intersects
            [[6, 4, 4], [4, 6, 7.6], false],//first inside second
            [[6, 4, 4], [14, 4, 4], false],//tangent
            [[6, 4, 4], [9, 4, 1], true],//tangent from inside
        ];
    }

    /**
     * @return array
     */
    public function circleContainsRectangleProvider():array
    {
        //[circle1[x1,y1,radius], rect[x1,y1,x2,y2], , contains]
        return [
            [[4, 6, 4], [2, 9, 7, 5], false],//intersects
            [[4, 6, 4], [2, 9, 6, 5], true],//inside
            [[4, 6, 4], [0, 9, 7, 5], false],//intersects
            [[4, 6, 4], [2, 9.5, 6, 2,6], false],//inscriibed
        ];
    }

    /**
     * @return array
     */
    public function rectangleContainsPointProvider():array
    {
        //[rectangle[x1,y1,x2,y2], point[x1,y1] , contains]
        return [
            [[2, 8, 12, -6], [4, 6], true],//inside
            [[2, 8, 12, -6], [0, 6], false],//outside
            [[2, 8, 12, -6], [4, 8], true],//on side
            [[2, 8, 12, -6], [2, 8], true],//on corner
        ];
    }

    /**
     * @return array
     */
    public function rectangleContainsSegmentProvider(): array
    {
        //[rectangle[x1,y1,x2,y2], segment[x1,y1,x2,y2] , contains]
        return [
            [[2, 8, 12, -6], [0, 6, 14, 0], false],//intersect
            [[2, 8, 12, -6], [4, 6, 14, 0], false],//one end inside
            [[2, 8, 12, -6], [4, 6, 14, 0], false],//one end inside
            [[2, 8, 12, -6], [4, 6, 10, 0], true],//inseide
        ];
    }

    /**
     * @return array
     */
    public function rectangleContainsCircleProvider(): array
    {
        //[rectangle[x1,y1,x2,y2], circle[x1,y1,radius] , contains]
        return [
            [[2, 8, 12, -6], [8, 2, 4.5], false],//intersect
            [[2, 8, 12, -6], [8, 2, 3.2], true],//inside
            [[2, 8, 12, -6], [100, 100, 200], false],//rect inside circle
            [[2, 8, 12, -6], [100, 100, 2], false],//outside
        ];
    }

    /**
     * @return array
     */
    public function rectangleContainsRectangleProvider(): array
    {
        //[rectangle1[x1,y1,x2,y2], rectangle1[x1,y1,x2,y2], contains]
        return [
            [[2, 8, 12, -6], [10, 10, 14, 6], false],//intersect
            [[2, 8, 12, -6], [4, 6, 10, 0], true],//inside
            [[2, 8, 12, -6], [100, 1006, 10000, 10000], false],//outside
        ];
    }

}
