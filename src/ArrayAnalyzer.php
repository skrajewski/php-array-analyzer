<?php

namespace Szykra\ArrayAnalyzer;

use Szykra\ArrayAnalyzer\Exception\MismatchArrayException;
use Szykra\ArrayAnalyzer\Exception\MismatchElementsException;

class ArrayAnalyzer
{

    /**
     * Recognize a single position change of one element in
     * array by analyzing before and after arrays
     *
     * @param array $before
     * @param array $after
     * @return array
     *
     * @throws MismatchArrayException
     * @throws MismatchElementsException
     */
    public static function checkOrderChange(array $before, array $after)
    {
        $count = count($before);

        if ($count !== count($after)) {
            throw new MismatchArrayException();
        }

        if (array_diff($before, $after)) {
            throw new MismatchElementsException();
        }

        foreach ($after as $index => $element) {
            if ($before[$index] === $element) {
                continue;
            }

            if ($index + 1 < $count && $before[$index + 1] === $element) {
                continue;
            }

            return [
                'from' => array_search($element, $before, true),
                'to' => $index,
                'element' => $element
            ];
        }

        return [];
    }

    /**
     * Check if array is sequential
     *
     * @param array $array
     * @return bool
     */
    public static function isSequential(array $array)
    {
        $count = count($array);

        return !($count && array_keys($array) !== range(0, $count - 1));
    }

    /**
     * Check if array is associative
     *
     * @param array $array
     * @return bool
     */
    public static function isAssoc(array $array)
    {
        return !static::isSequential($array);
    }

    /**
     * Get max depth for array
     * For one dimensional array the result is 1
     *
     * @param array $array
     * @return int
     */
    public static function getMaxDepth(array $array)
    {
        $maxDepth = function (array $array, $depth) use (&$maxDepth) {
            $elements = array_filter($array, 'is_array');

            return array_reduce($elements, function ($max, $element) use ($maxDepth) {
                return max($max, $maxDepth($element, $max + 1));
            }, $depth);
        };

        return $maxDepth($array, 1);
    }
}