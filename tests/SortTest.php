<?php

declare(strict_types=1);

namespace Tests\Kassa;

use Kassa\Sort;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{
    public function testUsort(): void
    {
        $array = [10, 5, 3, 7, 0, 8, 0];
        Sort::usort($array, function (int $first, int $second) {
            return $first <=> $second;
        });
        $this->assertEquals($array, [0, 0, 3, 5, 7, 8, 10]);

        $array = [3 => 10, 10 => 5];
        Sort::usort($array, function (int $first, int $second) {
            return $first <=> $second;
        });
        $this->assertEquals($array, [5, 10]);
    }
}
