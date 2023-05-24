<?php

declare(strict_types=1);

namespace App;

use App\Shape\ShapeInterface;

class Math
{
    /**
     * Computes the surface of the given geometric shape.
     *
     * @param ShapeInterface $shape
     *
     * @return string
     */
    public function printShapeDetails(ShapeInterface $shape): string
    {
        return \sprintf(
            'The area of the %s is  %.2f and its perimeter is %.2f',
            $shape->getName(),
            $shape->area(),
            $shape->perimeter()
        );
    }

    public function getAllShapesNames(array $shapes): array
    {
        $names = [];
        /** @var ShapeInterface $figure */
        foreach ($shapes as $figure) {
            $names[] = $figure->getName();
        }

        return $names;
    }

    /**
     * @TODO Write unit tests for this function.
     *
     * @param int $a
     * @param int $b
     * @param int $c
     * @return string
     */
    public function secondDegreeEquation(int $a, int $b, int $c): string
    {
        $d = $this->computeDelta($a, $b, $c);

        return match (true) {
            $d > 0 => 'The equation accepts 2 real roots',
            0.0 === $d => 'The equation accepts 1 real root',
            default => 'No real root'
        };
    }

    private function computeDelta(int $a, int $b, int $c): float
    {
        return ($b ** 2) - (4 * $a * $c);
    }
}