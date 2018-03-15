<?php


namespace AppTest\Geometry;


use PHPUnit\Framework\TestCase;

class ShapeTest extends TestCase
{
    public function testName()
    {
        $stub = $this->getMockForAbstractClass('App\Geometry\Shape');
        $this->assertEquals('shape', $stub->getName());
    }

}