<?php

declare(strict_types=1);

namespace Kassa;

class Leaf
{
    protected int $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new \LogicException('The weight must be greater than zero.', 400);
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
