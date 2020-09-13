<?php

declare(strict_types=1);

namespace Kassa;

class Sort
{
    public static function usort(&$array, callable $function): void
    {
        if (count($array) < 2) {
            return;
        }

        $array = array_values($array);
        self::quickSort($array, 0, count($array) - 1, $function);
    }

    /**
     * Divide the entire array into two parts, smaller and larger than the pivot elements.
     * Then we perform similar actions for each of the resulting parts.
     */
    private static function quickSort(array &$array, int $left, int $right, callable $function): void
    {
        $index = self::partition($array, $left, $right, $function);
        if ($left < $index - 1) {
            self::quickSort($array, $left, $index - 1, $function);
        }

        if ($index < $right) {
            self::quickSort($array, $index, $right, $function);
        }
    }

    /**
     * Swap array elements.
     */
    private static function swap(array &$array, int $firstIndex, int $secondIndex): void
    {
        $temp = $array[$firstIndex];
        $array[$firstIndex] = $array[$secondIndex];
        $array[$secondIndex] = $temp;
    }

    /**
     * Divide the array into 3 parts in the specified interval.
     */
    private static function partition(array &$array, int $left, int $right, callable $function): int
    {
        $pivot = $array[($right + $left) / 2];
        while ($left <= $right) {
            while ($function($array[$left], $pivot) === -1) {
                $left++;
            }

            while ($function($array[$right], $pivot) === 1) {
                $right--;
            }

            if ($left <= $right) {
                self::swap($array, $left, $right);
                $left++;
                $right--;
            }
        }

        return $left;
    }
}
