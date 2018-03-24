<?php


namespace AppTest\AppTest\Geometry;


use App\Geometry\Segment;
use PHPUnit\Framework\TestCase;

class SegmentTest extends TestCase
{
    public function testArea()
    {
        $segment = new Segment(0, 0, 10, 10);
        $this->assertEquals(0, $segment->getArea());
    }

    public function testPerimeter()
    {
        $segment = new Segment(0, 10, 10, 10);
        $this->assertEquals(10, $segment->getPerimeter());
    }
}