<?php

declare(strict_types=1);

namespace Kassa;

class Sort
{
    public static function usort(&$array, callable $function): void
    {
        \usort($array, $function);
    }
}
