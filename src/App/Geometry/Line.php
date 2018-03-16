<?php


namespace App\Geometry;


class Line extends Shape
{
    protected const SHAPE_NAME = 'line';

    /**
     * @var Point
     */
    protected $start;

    /**
     * @var Point
     */
    protected $end;

    /**
     * Line constructor.
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     */
    public function __construct(float $x1, float $y1, float $x2, float $y2)
    {
        $this->start = new Point($x1, $y1);
        $this->end = new Point($x2, $y2);
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
        return $this->start->distance($this->end);
    }

    /**
     * @return Point
     */
    public function getStart(): Point
    {
        return $this->start;
    }

    /**
     * @param Point $start
     */
    public function setStart(Point $start): void
    {
        $this->start = $start;
    }

    /**
     * @return Point
     */
    public function getEnd(): Point
    {
        return $this->end;
    }

    /**
     * @param Point $end
     */
    public function setEnd(Point $end): void
    {
        $this->end = $end;
    }
}