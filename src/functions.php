<?php

namespace Szykra\Helper;

/**
 * // todo throw exception when array is associative
 * // todo throw exception when is not simple change in array
 * // todo throw exception when array contains different element
 * // todo refactor
 *
 * @param array $before
 * @param array $after
 * @return array
 */
function array_order_change(array $before, array $after)
{
    $count = count($before);

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
