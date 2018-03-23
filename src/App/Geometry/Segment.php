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
     * Ax+By+C=0
     * @return array
     */
    public function getLineEquationCoeefs(): array
    {
        $y1 = $this->getStart()->getY();
        $y2 = $this->getEnd()->getY();

        $x1 = $this->getStart()->getX();
        $x2 = $this->getEnd()->getX();

        $A = $y1 - $y2;
        $B = $x2 - $x1;
        $C = $x1 * $y2 - $x2 * $y1;

        return [
            'A' => $A,
            'B' => $B,
            'C' => $C
        ];
    }

//
//    /**
//     * @param Segment $line
//     * @return bool
//     */
//
//    /**
//     * @return bool
//     */
//    public function isIntersectCircle(Circle $circle): bool
//    {
//        //        AND IN RANGE!!
//        $r = $circle->getRadius();
//        return $this->getDistanceToPoint($circle);
//    }

    /**
     * @param Point $point
     * @return float
     */
    public function getDistanceToPoint(Point $point): float
    {
        $coeffs = $this->getLineEquationCoeefs();
        return abs(
            ($coeffs['A'] * $point->getX() + $coeffs['B'] * $point->getY() + $coeffs['C'])
            / sqrt(pow($coeffs['A'], 2) + pow($coeffs['B'], 2))
        );
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