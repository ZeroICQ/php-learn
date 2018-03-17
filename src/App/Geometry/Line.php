<?php


namespace App\Geometry;


class Line extends Shape
{
//  TODO add getters
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

    /**
     * @param Shape $shape
     * @return bool
     */
    public function isContains(Shape $shape): bool
    {
        switch ($shape->getName()) {
            case 'point';
                return $this->isContainsPoint($shape);
            case 'line':
                return $this->isContainsLine($shape);
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
        $eps = 0.0001;

        $y = $point->getY();
        $y1 = $this->getStart()->getY();
        $y2 = $this->getEnd()->getY();

        $x = $point->getX();
        $x1 = $this->getStart()->getX();
        $x2 = $this->getEnd()->getX();

        $coeffs = $this->getLineEquationCoeefs();

        $isLineEquation = abs($coeffs['A'] * $x + $coeffs['B'] * $y + $coeffs['C']) <= $eps;
        $isInXRange = min($x1, $x2) <= $x && $x <= max($x1, $x2);
        return $isLineEquation && $isInXRange;
    }

    /**
     * @param Line $shape
     * @return bool
     */
    public function isContainsLine(Line $shape): bool
    {
        return $this->getStart()->isEqualTo($shape->getStart()) && $this->getEnd()->isEqualTo($shape->getEnd());
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