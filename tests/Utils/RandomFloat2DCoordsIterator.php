<?php
/**
 * USELESS
 */

namespace TestUtils;


use Iterator;
use SplFixedArray;

class RandomFloat2DCoordsIterator implements Iterator
{
    /**
     * @var SplFixedArray
     */
    private $coords;

    /**
     * @var int
     */
    private $position;

    /**
     * RandomFloat2DCoordsIterator constructor.
     * @param float $min
     * @param float $max
     * @param float $amount
     */
    public function __construct(float $min, float $max, float $amount)
    {
        $this->position = 0;
        $this->coords = new SplFixedArray(2 * $amount);

        foreach ($this->coords as $key => $field) {
            $this->coords[$key] = MathUtils::randomFloat($min, $max);
        }
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return [[$this->coords[$this->position], $this->coords[$this->position+1]]];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->position += 2;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return 0 <= $this->position && $this->position <= $this->coords->getSize() - 1 && $this->position % 2 == 0;
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
    }
}