<?php


namespace App\Geometry;

use App\Utils\Misc;

abstract class GeometryUtils
{
    public const EPS = 0.0000001;

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
        //Rectangle-Rectangle
        if ($name1 == 'rectangle' && $name2 == 'rectangle') {
            return self::isRectangleIntersectsRectangle($shape1, $shape2);
        }
        //Rectangle-Circle
        if ($name1 == 'rectangle' && $name2 == 'circle') {
            return self::isRectangleIntersectsCircle($shape1, $shape2);
        } elseif ($name1 == 'circle' && $name2 == 'rectangle') {
            return self::isRectangleIntersectsCircle($shape2, $shape1);
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
        //Point
        if ($name1 == 'point') {
            if ($name2 == 'point') {
                return self::isPointContainsPoint($shape1, $shape2);
            } else {
                return false;
            }
        }
        //Segment
        if ($name1 == 'segment') {
            if ($name2 == 'point') {
                return self::isSegmentContainsPoint($shape1, $shape2);
            } elseif ($name2 == 'segment') {
                return self::isSegmentContainsSegment($shape1, $shape2);
            } else {
                return false;
            }
        }

        //Circle-Point
        if ($name1 == 'circle' && $name2 == 'point') {
            return self::isCircleContainsPoint($shape1, $shape2);
        }
        //Circle-Segment
        if ($name1 == 'circle' && $name2 == 'segment') {
            return self::isCircleContainsSegment($shape1, $shape2);
        }
        //Circle-Circle
        if ($name1 == 'circle' && $name2 == 'circle') {
            return self::isCircleContainsCircle($shape1, $shape2);
        }
        //Circle-Rectangle
        if ($name1 == 'circle' && $name2 == 'rectangle') {
            return self::isCircleContainsRectangle($shape1, $shape2);
        }

        //Rectangle-Point
        if ($name1 == 'rectangle' && $name2 == 'point') {
            return self::isRectangleContainsPoint($shape1, $shape2);
        }
        //Rectangle-Segment
        if ($name1 == 'rectangle' && $name2 == 'segment') {
            return self::isRectangleContainsSegment($shape1, $shape2);
        }
        //Rectangle-Circle
        if ($name1 == 'rectangle' && $name2 == 'circle') {
            return self::isRectangleContainsCircle($shape1, $shape2);
        }
        //Rectangle-Rectangle
        if ($name1 == 'rectangle' && $name2 == 'rectangle') {
            return self::isRectangleContainsRectangle($shape1, $shape2);
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
        return abs(self::area($segment->getStart(), $segment->getEnd(), $point)) < self::EPS
            && ($segment->getStart()->getX() - $point->getX()) * ($segment->getEnd()->getX() - $point->getX())
             + ($segment->getStart()->getY() - $point->getY()) * ($segment->getEnd()->getY() - $point->getY()) <= self::EPS;
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
     * @param Rectangle $rect1
     * @param Rectangle $rect2
     * @return bool
     */
    private static function isRectangleIntersectsRectangle(Rectangle $rect1, Rectangle $rect2): bool
    {
        foreach ($rect1->getSides() as $side) {
            if (GeometryUtils::isIntersects($side, $rect2)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Rectangle $rect
     * @param Circle $circle
     * @return bool
     */
    private static function isRectangleIntersectsCircle(Rectangle $rect, Circle $circle): bool
    {
        foreach ($rect->getSides() as $side) {
            if (GeometryUtils::isIntersects($side, $circle)) {
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
        return GeometryUtils::isIntersects($segment1, $segment2->getStart())
            && GeometryUtils::isIntersects($segment1, $segment2->getEnd());
    }

    /**
     * @param Segment $segment
     * @param Point $point
     * @return bool
     */
    private static function isSegmentContainsPoint(Segment $segment, Point $point): bool
    {
        return GeometryUtils::isIntersects($segment, $point);
    }

    /**
     * @param Circle $circle
     * @param Point $point
     * @return bool
     */
    private static function isCircleContainsPoint(Circle $circle, Point $point): bool
    {
        return $circle->getCenter()->distance($point) <= $circle->getRadius() + self::EPS;
    }

    /**
     * @param Circle $circle
     * @param Segment $segment
     * @return bool
     */
    private static function isCircleContainsSegment(Circle $circle, Segment $segment): bool
    {
        return GeometryUtils::isContains($circle, $segment->getStart())
            && GeometryUtils::isContains($circle, $segment->getEnd());
    }

    /**
     * @param Circle $circle1
     * @param Circle $circle2
     * @return bool
     */
    private static function isCircleContainsCircle(Circle $circle1, Circle $circle2): bool
    {
        $centersDistance = $circle1->getCenter()->distance($circle2->getCenter());
        return $centersDistance + $circle2->getRadius() <= 2 * $circle1->getRadius() + self::EPS ;
    }

    /**
     * @param Circle $circle
     * @param Rectangle $rect
     * @return bool
     */
    private static function isCircleContainsRectangle(Circle $circle, Rectangle $rect)
    {
        foreach ($rect->getCorners() as $corner) {
            if ($circle->getCenter()->distance($corner) > $circle->getRadius() + self::EPS) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param Rectangle $rectangle
     * @param Point $point
     * @return bool
     */
    private static function isRectangleContainsPoint(Rectangle $rectangle, Point $point): bool
    {
        return  $rectangle->getTopLeft()->getX() <= $point->getX() + self::EPS
            && $rectangle->getTopRight()->getX() >= $point->getX() - self::EPS
            && $rectangle->getTopLeft()->getY() >= $point->getY() - self::EPS
            && $rectangle->getBottomRight()->getY() <= $point->getY() + self::EPS;
    }

    /**
     * @param Rectangle $rectangle
     * @param Segment $segment
     * @return bool
     */
    private static function isRectangleContainsSegment(Rectangle $rectangle, Segment $segment): bool
    {
        return GeometryUtils::isContains($rectangle, $segment->getStart())
            && GeometryUtils::isContains($rectangle, $segment->getEnd());
    }

    /**
     * @param Rectangle $rectangle
     * @param Circle $circle
     * @return bool
     */
    private static function isRectangleContainsCircle(Rectangle $rectangle, Circle $circle): bool
    {
        if (GeometryUtils::isContains($rectangle, $circle->getCenter())) {
            return false;
        }
        foreach ($rectangle->getSides() as $side) {
            if (GeometryUtils::isIntersects($side, $circle)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Rectangle $rect1
     * @param Rectangle $rect2
     * @return bool
     */
    private static function isRectangleContainsRectangle(Rectangle $rect1, Rectangle $rect2): bool
    {
        foreach ($rect2->getCorners() as $corner) {
            if (!GeometryUtils::isContains($rect1, $corner)) {
                return false;
            }
        }
        return true;
    }
}
