<?php

declare(strict_types=1);

namespace App\Shape;

class Square extends Rectangle
{
    public function __construct(protected int $a)
    {
        parent::__construct($a, $a);
    }

    public function getName(): string
    {
        return 'Square';
    }
}