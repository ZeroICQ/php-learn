<?php


namespace App\Geometry;

use App\Utils\Misc;

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
        //Segment-Circle
        if ($name1 == 'segment' && $name2 == 'circle') {
            return self::isSegmentIntersectsCircle($shape1, $shape2);
        } elseif ($name1 == 'circle' && $name2 == 'segment') {
            return self::isSegmentIntersectsCircle($shape2, $shape1);
        }
        //Point-Circle
        if ($name1 == 'point' && $name2 == 'circle') {
            return self::isPointIntersectsCircle($shape1, $shape2);
        } elseif ($name1 == 'circle' && $name2 == 'point') {
            return self::isPointIntersectsCircle($shape2, $shape1);
        }
        //Circle-Circle
        if ($name1 == 'circle' && $name2 == 'circle') {
            return self::isCircleIntersectsCircle($shape1, $shape2);
        }
        //Rectangle-Point
        if ($name1 == 'rectangle' && $name2 == 'point') {
            return self::isRectangleIntersectsPoint($shape1, $shape2);
        } elseif ($name1 == 'point' && $name2 == 'rectangle') {
            return self::isRectangleIntersectsPoint($shape2, $shape1);
        }
        //Rectangle-Segment
        if ($name1 == 'rectangle' && $name2 == 'segment') {
            return self::isRectangleIntersectsSegment($shape1, $shape2);
        } elseif ($name1 == 'segment' && $name2 == 'rectangle') {
            return self::isRectangleIntersectsSegment($shape2, $shape1);
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
        $y1 = $segment->getStart()->getY();
        $y2 = $segment->getEnd()->getY();

        $x = $point->getX();
        $x1 = $segment->getStart()->getX();
        $x2 = $segment->getEnd()->getX();

        $coeffs = $segment->getLineEquationCoeefs();

        // both equation and in range
        return abs($coeffs['A'] * $x + $coeffs['B'] * $y + $coeffs['C']) <= self::EPS
            && min($x1, $x2) <= $x && $x <= max($x1, $x2)
            && min($y1, $y2) <= $y && $x <= max($y1, $y2);
    }

    /**
     * @param Segment $segment1
     * @param Segment $segment2
     * @return bool
     */
    private static function isSegmentIntersectsSegment(Segment $segment1, Segment $segment2): bool
    {
        $a = $segment1->getStart();
        $b = $segment1->getEnd();
        $c = $segment2->getStart();
        $d = $segment2->getEnd();

        $aX = $segment1->getStart()->getX();
        $bX = $segment1->getEnd()->getX();
        $cX = $segment2->getStart()->getX();
        $dX= $segment2->getEnd()->getX();

        $aY = $segment1->getStart()->getY();
        $bY = $segment1->getEnd()->getY();
        $cY = $segment2->getStart()->getY();
        $dY = $segment2->getEnd()->getY();

        return self::intersect_1($aX, $bX, $cX, $dX)
            && self::intersect_1($aY, $bY, $cY, $dY)
            && Misc::sign(self::area($a, $b, $c)) * Misc::sign(self::area($a, $b, $d)) <= 0
            && Misc::sign(self::area($c, $d, $a)) * Misc::sign(self::area($c, $d, $b)) <= 0;
    }

    /**
     * @param float $a
     * @param float $b
     * @param float $c
     * @param float $d
     * @return bool
     */
    private static function intersect_1(float $a, float $b, float $c, float $d): bool
    {
        // bounding check
        if ($a > $b) Misc::swap($a, $b);
        if ($c > $d) Misc::swap($c, $d);
        return max($a, $c) <= min($b, $d);
    }

    /**
     * @param Point $a
     * @param Point $b
     * @param Point $c
     * @return float
     */
    private static function area(Point $a, Point $b, Point $c): float
    {
        return ($b->getX() - $a->getX()) * ($c->getY() - $a->getY()) - ($b->getY() - $a->getY()) * ($c->getX() - $a->getX());
    }

    /**
     * @param Segment $segment
     * @param Circle $circle
     * @return bool
     */
    private static function isSegmentIntersectsCircle(Segment $segment, Circle $circle): bool
    {
        $r = $circle->getRadius();

        $aX = $segment->getStart()->getX() - $circle->getCenter()->getX();
        $aY = $segment->getStart()->getY() - $circle->getCenter()->getY();
        $bX = $segment->getEnd()->getX() - $circle->getCenter()->getX();
        $bY = $segment->getEnd()->getY() - $circle->getCenter()->getY();

        $A = $aY - $bY;
        $B = $bX - $aX;
        $C = $aX * $bY - $bX * $aY;

        $x0 = -$A * $C / ($A * $A + $B * $B);
        $y0 = -$B * $C / ($A * $A + $B * $B);

        if ($C * $C > $r * $r * ($A * $A + $B * $B) + self::EPS) {
            return false;
        } elseif (abs($C * $C - $r * $r * ($A * $A + $B * $B)) < self::EPS) {
            // one point
            return false;//tangents
        } else {
            $d = $r * $r - $C * $C/($A * $A + $B * $B);
            $mult = sqrt($d/(($A * $A + $B * $B)));

            $p1 = new Point(
                $x0 + $B * $mult + $circle->getCenter()->getX(),
                $y0 - $A * $mult + $circle->getCenter()->getY()
            );

            $p2 = new Point(
                $x0 - $B * $mult + $circle->getCenter()->getX(),
                $y0 + $A * $mult + $circle->getCenter()->getY()
            );
            return self::isContains($segment, $p1) || self::isContains($segment, $p2);
        }
    }

    /**
     * @param Point $point
     * @param Circle $circle
     * @return bool
     */
    private static function isPointIntersectsCircle(Point $point, Circle $circle): bool
    {
        return abs(pow($point->getX() - $circle->getCenter()->getX(), 2)
             + pow($point->getY() - $circle->getCenter()->getY(), 2)
             - pow($circle->getRadius(), 2)) < self::EPS;
    }

    /**
     * @param Circle $circle1
     * @param Circle $circle2
     * @return bool
     */
    private static function isCircleIntersectsCircle(Circle $circle1, Circle $circle2): bool
    {
        return $circle1->getCenter()->distance($circle2->getCenter()) < $circle1->getRadius() + $circle2->getRadius();
    }

    /**
     * @param Rectangle $rect
     * @param Point $point
     * @return bool
     */
    private static function isRectangleIntersectsPoint(Rectangle $rect, Point $point): bool
    {
        foreach ($rect->getSides() as $side) {
            if (GeometryUtils::isIntersects($side, $point)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Rectangle $rect
     * @param Segment $segment
     * @return bool
     */
    private static function isRectangleIntersectsSegment(Rectangle $rect, Segment $segment): bool
    {
        foreach ($rect->getSides() as $side) {
            if (GeometryUtils::isIntersects($side, $segment)) {
                return true;
            }
        }
        return false;
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

    /**
     * @param Segment $segment1
     * @param Segment $segment2
     * @return bool
     */
    private static function isSegmentContainsSegment(Segment $segment1, Segment $segment2): bool
    {
        return $segment1->getStart()->isEqualTo($segment2->getStart())
            && $segment1->getEnd()->isEqualTo($segment2->getEnd());
    }
}
