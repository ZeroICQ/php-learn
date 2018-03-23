<?php


namespace App\Geometry;


abstract class GeometryUtils
{
    public const EPS = 0.0001;

    /**
     * private constructor
     */
    private function __construct() {}

    /**
     * @param ShapeInterface $shape1
     * @param ShapeInterface $shape2
     * @return bool
     */
    public static function isIntersects(ShapeInterface $shape1, ShapeInterface $shape2): bool
    {
        $name1 = $shape1->getName();
        $name2 = $shape2->getName();
        //Point-Point
        if ($name1 == 'point' && $name2 == 'point') {
            return self::isPointIntersectsPoint($shape1, $shape2);
        }
        //Point-Segment
        if ($name1 == 'point' && $name2 == 'segment') {
            return self::isPointIntersectsSegment($shape1, $shape2);
        } elseif ($name1 == 'segment' && $name2 == 'point') {
            return self::isPointIntersectsSegment($shape2, $shape1);
        }
        //Segment-Segment
        if ($name1 == 'segment' && $name2 == 'segment') {
            return self::isSegmentIntersectsSegment($shape1, $shape2);
        }

        return false;
    }

    /**
     * @param ShapeInterface $shape1
     * @param ShapeInterface $shape2
     * @return bool
     */
    public static function isContains(ShapeInterface $shape1, ShapeInterface $shape2): bool
    {
        $name1 = $shape1->getName();
        $name2 = $shape2->getName();
        // Point-Point
        if ($name1 == 'point' && $name2 == 'point') {
            return self::isPointContainsPoint($shape1, $shape2);
        }
        //Point-Segment
        if ($name1 == 'point' && $name2 == 'segment'){
            return self::isPointIntersectsSegment($shape1, $shape2);
        } elseif ($name1 == 'segment' && $name2 == 'point') {
            return self::isPointIntersectsSegment($shape2, $shape1);
        }
        //Segment-Segment
        if ($name1 == 'segment' && $name2 == 'segment') {
            return self::isSegmentContainsSegment($shape1, $shape2);
        }

        return false;
    }

    /**
     * @param Point $point1
     * @param Point $point2
     * @return bool
     */
    private static function isPointIntersectsPoint(Point $point1, Point $point2): bool
    {
        return $point1->isEqualTo($point2);
    }

    private static function isPointIntersectsSegment(Point $point, Segment $segment): bool
    {
        $y = $point->getY();

        $x = $point->getX();
        $x1 = $segment->getStart()->getX();
        $x2 = $segment->getEnd()->getX();

        $coeffs = $segment->getLineEquationCoeefs();

        // both equation and in range
        return abs($coeffs['A'] * $x + $coeffs['B'] * $y + $coeffs['C']) <= self::EPS
            && min($x1, $x2) <= $x && $x <= max($x1, $x2);
    }

    /**
     * @param Segment $segment1
     * @param Segment $segment2
     * @return bool
     */
    private static function isSegmentIntersectsSegment(Segment $segment1, Segment $segment2): bool
    {
        $c1 = $segment1->getLineEquationCoeefs();
        $c2 = $segment2->getLineEquationCoeefs();

        //not parallel or same
        return !($c1['A'] * $c2['B'] - $c2['A'] * $c1['B']) < self::EPS
            || GeometryUtils::isContains($segment1, $segment2->getStart());

    }

    /**
     * @param Point $point1
     * @param Point $point2
     * @return bool
     */
    private static function isPointContainsPoint(Point $point1, Point $point2): bool
    {
        return $point1->isEqualTo($point2);
    }

    private static function isSegmentContainsSegment(Segment $segment1, Segment $segment2)
    {
        return $segment1->getStart()->isEqualTo($segment2->getStart())
            && $segment1->getEnd()->isEqualTo($segment2->getEnd());
    }
}