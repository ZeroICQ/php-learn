<?php


namespace App\Geometry;


class Rectangle extends Shape
{
    protected const SHAPE_NAME = 'rectangle';

    /**
     * @var Point
     */
    protected $topLeft;

    /**
     * @var Point
     */
    protected $topRight;

    /**
     * @var Point
     */
    protected $bottomRight;

    /**
     * @var Point
     */
    protected $bottomLeft;

    /**
     * Rectangle constructor.
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function __construct(float $x1, float $y1, float $x2, float $y2)
    {
        $this->topLeft = new Point($x1, $y1);
        $this->topRight = new Point($x2, $y1);
        $this->bottomRight = new Point($x2, $y2);
        $this->bottomLeft = new Point($x1, $y2);
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->topLeft->distance($this->topRight);
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->topRight->distance($this->bottomRight);
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return  $this->getLength() * $this->getWidth();
    }

    /**
     * @return float
     */
    public function getPerimeter(): float
    {
        return 2 *  $this->getLength() + 2 * $this->getWidth();
    }
}