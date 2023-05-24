<?php

declare(strict_types=1);

namespace App\Shape;

class Circle implements ShapeInterface
{
    private const PI = 3.14;

    public function __construct(private readonly int $r)
    {
    }

    public function area(): float
    {
        return \round(self::PI * ($this->r ** 2), 2);
    }

    public function perimeter(): float
    {
        return \round(2 * self::PI * $this->r, 2);
    }

    public function getName(): string
    {
        return 'Circle';
    }
}