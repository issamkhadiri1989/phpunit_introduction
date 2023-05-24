<?php

declare(strict_types=1);

namespace App\Shape;

class Rectangle implements ShapeInterface
{
    public function __construct(private readonly int $a, private readonly int $b)
    {
    }

    public function area(): float
    {
        return $this->a * $this->b;
    }

    public function perimeter(): float
    {
        return ($this->a + $this->b) * 2;
    }

    public function getName(): string
    {
        return 'Rectangle';
    }
}