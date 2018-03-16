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
        return  $this->getTopLeft()->getX() <= $point->getX()
            && $this->getTopRight()->getX() >= $point->getX()
            && $this->getTopLeft()->getY() >= $point->getY()
            && $this->getBottomRight()->getY() <= $point->getY();
    }

    /**
     * @param Line $line
     * @return bool
     */
    public function isContainsLine(Line $line): bool
    {
        return $this->isContainsPoint($line->getStart()) && $this->isContainsPoint($line->getEnd());
    }

    /**
     * @param Circle $circle
     * @return bool
     */
    public function isContainsCircle(Circle $circle): bool
    {
        $rectCenter = new Point(
            abs($this->getTopLeft()->getX() - $this->getBottomRight()->getX()) / 2,
            abs($this->getTopLeft()->getY() - $this->getBottomRight()->getY()) / 2
        );

        $centersDistance = $rectCenter->distance($circle->getCenter());
        return $circle->getRadius() + $centersDistance <= min($this->getWidth(), $this->getLength());
    }

    /**
     * @param Rectangle $rect
     * @return bool
     */
    public function isContainsRectangle(Rectangle $rect): bool
    {
        $isTopLeftOk = $this->getTopLeft()->getX() <= $rect->getTopLeft()->getX()
            && $this->getTopLeft()->getY() >= $rect->getTopLeft()->getY();

        $isTopRightOk = $this->getTopRight()->getX() >= $rect->getTopRight()->getX()
            && $this->getTopRight()->getY() >= $rect->getTopRight()->getY();

        $isBottomRightOk = $this->getBottomRight()->getX() >= $rect->getBottomRight()->getX()
            && $this->getBottomRight()->getY() <= $rect->getBottomRight()->getY();

        $isBottomLeftOk = $this->getBottomLeft()->getX() <= $rect->getBottomLeft()->getX()
            && $this->getBottomLeft()->getY() >= $rect->getBottomLeft()->getY();

        return $isTopLeftOk && $isTopRightOk && $isBottomRightOk && $isBottomLeftOk;
    }
    /**
     * @return Point
     */
    public function getTopLeft(): Point
    {
        return $this->topLeft;
    }

    /**
     * @param Point $topLeft
     */
    public function setTopLeft(Point $topLeft): void
    {
        $this->topLeft = $topLeft;
    }

    /**
     * @return Point
     */
    public function getTopRight(): Point
    {
        return $this->topRight;
    }

    /**
     * @param Point $topRight
     */
    public function setTopRight(Point $topRight): void
    {
        $this->topRight = $topRight;
    }

    /**
     * @return Point
     */
    public function getBottomRight(): Point
    {
        return $this->bottomRight;
    }

    /**
     * @param Point $bottomRight
     */
    public function setBottomRight(Point $bottomRight): void
    {
        $this->bottomRight = $bottomRight;
    }

    /**
     * @return Point
     */
    public function getBottomLeft(): Point
    {
        return $this->bottomLeft;
    }

    /**
     * @param Point $bottomLeft
     */
    public function setBottomLeft(Point $bottomLeft): void
    {
        $this->bottomLeft = $bottomLeft;
    }
}
