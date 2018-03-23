<?php


namespace App\Geometry;


class Segment implements ShapeInterface
{
    /**
     * @var Point
     */
    private $start;

    /**
     * @var Point
     */
    private $end;

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
     * @return string
     */
    public function getName(): string
    {
        return 'segment';
    }

    /**
     * @return Point
     */
    public function getStart(): Point
    {
        return $this->start;
    }

    /**
     * @return Point
     */
    public function getEnd(): Point
    {
        return $this->end;
    }
}