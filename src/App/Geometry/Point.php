<?php


namespace App\Geometry;


class Point implements ShapeInterface
{
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
        return abs($this->getX() - $point->getX()) < GeometryUtils::EPS
            && abs($this->getY() - $point->getY()) < GeometryUtils::EPS;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'point';
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
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
}