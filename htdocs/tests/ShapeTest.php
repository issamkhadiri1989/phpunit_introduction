<?php

declare(strict_types=1);

namespace App\Tests;

use App\Math;
use App\Shape\{Circle, Rectangle, ShapeInterface, Square, Triangle};
use PHPUnit\Framework\{Attributes\CoversClass, Attributes\DataProvider, Attributes\UsesClass, TestCase};

#[CoversClass(ShapeInterface::class)]
#[CoversClass(Circle::class)]
#[CoversClass(Rectangle::class)]
#[CoversClass(Square::class)]
#[CoversClass(Triangle::class)]
#[UsesClass(Math::class)]
class ShapeTest extends TestCase
{
    #[DataProvider('shapesDataProvider')]
    public function testGeometricCalculations(
        ShapeInterface $shape,
        float $expectedArea,
        float $expectedPerimeter
    ): void {
        $area = $shape->area();
        $perimeter = $shape->perimeter();

        $this->assertEquals($area, $expectedArea);
        $this->assertEquals($perimeter, $expectedPerimeter);
    }

    public function testMathematicalOperations(): void
    {
        $math = new Math();
        $circle = new Circle(5);

        $output = $math->printShapeDetails($circle);
        $this->assertStringContainsString('Circle', $output);
    }

    public static function shapesDataProvider(): array
    {
        return [
            'Calling Square Calculation' => [new Square(4), 16, 16],
            'Calling Circle Calculation' => [new Circle(5), 78.5, 31.4],
            'Calling Rectangle Calculation' => [new Rectangle(2, 4), 8, 12],
            'Calling Triangle Calculation' => [new Triangle(2, 3, 4), 2.905, 9],
        ];
    }
}
