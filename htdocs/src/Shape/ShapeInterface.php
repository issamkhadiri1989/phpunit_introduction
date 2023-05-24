<?php

namespace App\Shape;

interface ShapeInterface
{
    public function area(): float;

    public function perimeter(): float;

    public function getName(): string;
}