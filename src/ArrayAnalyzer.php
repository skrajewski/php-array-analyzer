<?php

namespace Szykra\ArrayAnalyzer;

use Szykra\ArrayAnalyzer\Exception\MismatchArrayException;
use Szykra\ArrayAnalyzer\Exception\MismatchElementsException;

class ArrayAnalyzer
{
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
}