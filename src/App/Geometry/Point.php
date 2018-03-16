<?php


namespace App\Geometry;


class Point extends Shape
{
    protected const SHAPE_NAME = 'point';

    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @param Point $other
     * @return float
     */
    public function distance(Point $other): float
    {
        return sqrt(
            pow($this->x - $other->getX(), 2) + pow($this->y - $other->getY(), 2)
        );
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function isEqualTo(Point $point)
    {
        return $this->getX() == $point->getX() && $this->getY() == $point->getY();
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @param float $x
     */
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * @param float $y
     * @return Point
     */
    public function setY(float $y): Point
    {
        $this->y = $y;
        return $this;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return 0;
    }

    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return 0;
    }

    /**
     * @param Shape $shape
     * @return bool
     */
    public function isContains(Shape $shape): bool
    {
        return $shape->getName() == 'point' && $this->isEqualTo($shape);
    }

}