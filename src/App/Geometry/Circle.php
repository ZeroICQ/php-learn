<?php


namespace App\Geometry;


class Circle implements ShapeInterface
{
    public const NAME = 'circle';

    /**
     * @var Point
     */
    private $getCenter;

    /**
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
        $this->getCenter = new Point($x, $y);
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

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return Point
     */
    public function getCenter(): Point
    {
        return $this->getCenter;
    }

    /**
     * @return float
     */
    public function getRadius(): float
    {
        return $this->radius;
    }
}