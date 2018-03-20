<?php


namespace App\Geometry;


interface ShapeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getArea(): float;

    /**
     * @return float
     */
    public function getPerimeter(): float;

    /**
     * @param Shape $shape
     * @return bool
     */
    public function isContains(Shape $shape): bool;

    /**
     * @param Shape $shape
     * @return bool
     */
    public function isIntersect(Shape $shape): bool;
}