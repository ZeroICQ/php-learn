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
     * @param Shape $shape
     * @return bool
     */
    public function isContains(Shape $shape): bool
    {
        switch ($shape->getName()) {
            case 'point':
                return $this->isContainsPoint($shape);
            case 'line':
                return $this->isContainsLine($shape);
            case 'circle':
                return $this->isContainsCircle($shape);
            case 'rectangle':
                return $this->isContainsRectangle($shape);
            default:
                return false;
        }
    }

    /**
     * @param Point $point
     * @return bool
     */
    public function isContainsPoint(Point $point): bool
    {
        return $this->center->distance($point) <= $this->radius;
    }

    /**
     * @param Line $line
     * @return bool
     */
    public function isContainsLine(Line $line): bool
    {
        return $this->center->distance($line->getStart()) <= $this->radius
            && $this->center->distance($line->getEnd()) <= $this->radius;
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isContainsCircle(Circle $circle): bool
    {
        $biggerCircle  = $this->getRadius() >= $circle->getRadius() ? $this : $circle;
        $smallerCircle  = $this->getRadius() < $circle->getRadius() ? $this : $circle;
        $biggerDiameter = 2 * $biggerCircle->radius;
        $centersDistance = $this->center->distance($circle->center);

        return $centersDistance + $smallerCircle->getRadius() <= $biggerDiameter;
    }

    /**
     * @param Rectangle $rect
     * @return bool
     */
    public function isContainsRectangle(Rectangle $rect): bool
    {
        $r = $this->radius;

        return $this->center->distance($rect->getTopLeft()) <= $r
        && $this->center->distance($rect->getTopRight()) <= $r
        && $this->center->distance($rect->getBottomRight()) <= $r
        && $this->center->distance($rect->getBottomLeft()) <= $r;
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