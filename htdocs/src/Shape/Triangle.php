<?php

declare(strict_types=1);

namespace App\Shape;

class Triangle implements ShapeInterface
{
    public function __construct(
        private readonly int $a,
        private readonly int $b,
        private readonly int $c
    ) {
    }

    /**
     * Computes the area using Heron's Formula.
     *
     * @return float
     */
    public function area(): float
    {
        $s = ($this->a + $this->b + $this->c) / 2;

        return \round(\sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c)), 3);
    }

    public function perimeter(): float
    {
        return $this->a + $this->b + $this->c;
    }

    public function getName(): string
    {
        return 'Triangle';
    }
}