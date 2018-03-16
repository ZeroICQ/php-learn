<?php


namespace App\Geometry;


class Circle extends Shape
{
    protected const SHAPE_NAME = 'circle';

    /**
     * @var Point
     */
    private $center;

    /*
     * @var float
     */
    private $radius;

    /**
     * Circle constructor.
     * @param float $x
     * @param float $y
     * @param float $radius
     */
    public function __construct(float $x, float $y, float $radius)
    {
        $center = new Point($x, $y);
        $this->radius = $radius;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return M_PI * pow($this->radius, 2);
    }

    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return 2 * M_PI * $this->radius;
    }

    /**
     * @return Point
     */
    public function getCenter(): Point
    {
        return $this->center;
    }

    /**
     * @param Point $center
     */
    public function setCenter(Point $center): void
    {
        $this->center = $center;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }

    /**
     * @param float $radius
     */
    public function setRadius(float $radius): void
    {
        $this->radius = $radius;
    }
}