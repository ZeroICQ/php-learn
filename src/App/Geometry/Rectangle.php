<?php


namespace App\Geometry;


class Rectangle implements ShapeInterface
{
    /**
     * @var Point
     */
    private $topLeft;

    /**
     * @var Point
     */
    private $bottomRight;

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
        $this->bottomRight = new Point($x2, $y2);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'rectangle';
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->topLeft->distance($this->getTopRight());
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->getTopRight()->distance($this->bottomRight);
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
        return 2 * ($this->getLength() + $this->getWidth());
    }

    /**
     * @return Segment
     */
    public function getUpperSide(): Segment
    {
        return new Segment(
            $this->getTopLeft()->getX(), $this->getTopLeft()->getY(),
            $this->getTopRight()->getX(), $this->getTopRight()->getY()
        );
    }

    /**
     * @return Segment
     */
    public function getRightSide(): Segment
    {
        return new Segment(
            $this->getTopRight()->getX(), $this->getTopRight()->getY(),
            $this->getBottomRight()->getX(), $this->getBottomRight()->getY()
        );
    }

    /**
     * @return Segment
     */
    public function getBottomSide(): Segment
    {
        return new Segment(
            $this->getBottomRight()->getX(), $this->getBottomRight()->getY(),
            $this->getBottomLeft()->getX(), $this->getBottomLeft()->getY()
        );
    }

    /**
     * @return Segment
     */
    public function getLeftSide(): Segment
    {
        return new Segment(
            $this->getBottomLeft()->getX(), $this->getBottomLeft()->getY(),
            $this->getTopLeft()->getX(), $this->getTopLeft()->getY()
        );
    }

    /**
     * @return array
     */
    public function getSides(): array
    {
        return [
            $this->getUpperSide(),
            $this->getRightSide(),
            $this->getBottomSide(),
            $this->getLeftSide(),
        ];
    }

    /**
     * @return array
     */
    public function getCorners():array
    {
        return [
            $this->getTopLeft(),
            $this->getTopRight(),
            $this->getBottomRight(),
            $this->getBottomLeft(),
        ];
    }

//
//    /**
//     * @param Segment $line
//     * @return bool
//     */
//    public function isContainsLine(Segment $line): bool
//    {
//        return $this->isContainsPoint($line->getStart()) && $this->isContainsPoint($line->getEnd());
//    }
//
//    /**
//     * @param Circle $circle
//     * @return bool
//     */
//    public function isContainsCircle(Circle $circle): bool
//    {
//        $rectCenter = new Point(
//            abs($this->getTopLeft()->getX() - $this->getBottomRight()->getX()) / 2,
//            abs($this->getTopLeft()->getY() - $this->getBottomRight()->getY()) / 2
//        );
//
//        $centersDistance = $rectCenter->distance($circle->getCenter());
//        return $circle->getRadius() + $centersDistance <= min($this->getWidth(), $this->getLength());
//    }
//
//    /**
//     * @param Rectangle $rect
//     * @return bool
//     */
//    public function isContainsRectangle(Rectangle $rect): bool
//    {
//        $isTopLeftOk = $this->getTopLeft()->getX() <= $rect->getTopLeft()->getX()
//            && $this->getTopLeft()->getY() >= $rect->getTopLeft()->getY();
//
//        $isTopRightOk = $this->getTopRight()->getX() >= $rect->getTopRight()->getX()
//            && $this->getTopRight()->getY() >= $rect->getTopRight()->getY();
//
//        $isBottomRightOk = $this->getBottomRight()->getX() >= $rect->getBottomRight()->getX()
//            && $this->getBottomRight()->getY() <= $rect->getBottomRight()->getY();
//
//        $isBottomLeftOk = $this->getBottomLeft()->getX() <= $rect->getBottomLeft()->getX()
//            && $this->getBottomLeft()->getY() >= $rect->getBottomLeft()->getY();
//
//        return $isTopLeftOk && $isTopRightOk && $isBottomRightOk && $isBottomLeftOk;
//    }

    /**
     * @return Point
     */
    public function getTopLeft(): Point
    {
        return $this->topLeft;
    }

    /**
     * @return Point
     */
    public function getTopRight(): Point
    {
        return new Point($this->getBottomRight()->getX(), $this->getTopLeft()->getY());
    }

    /**
     * @return Point
     */
    public function getBottomRight(): Point
    {
        return $this->bottomRight;
    }

    /**
     * @return Point
     */
    public function getBottomLeft(): Point
    {
        return new Point($this->getTopLeft()->getX(), $this->getBottomRight()->getY());
    }
}
