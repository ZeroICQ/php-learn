<?php


namespace App\Geometry;


abstract class Shape implements ShapeInterface
{
    protected const SHAPE_NAME = 'shape';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::SHAPE_NAME;
    }

}