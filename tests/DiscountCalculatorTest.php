<?php

declare(strict_types=1);

namespace App\Tests;

use App\DiscountCalculator;
use App\Order;
use Generator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\DiscountCalculator
 * @uses   \App\Order
 */
class DiscountCalculatorTest extends TestCase
{
    private DiscountCalculator $calculator;

    public static function provideDiscount(): Generator
    {
        yield 'no items' => [
            0,
            0,
            0,
        ];

        yield 'no discount 1' => [
            1,
            2,
            0,
        ];

        yield 'no discount 2' => [
            2,
            2,
            0,
        ];

        yield '5 percent' => [
            2,
            50,
            5,
        ];

        yield '10 percent' => [
            2,
            100,
            10,
        ];

        yield '15 percent 1' => [
            2,
            1000,
            15,
        ];

        yield '15 percent 2' => [
            2,
            4999,
            15,
        ];

        yield '20 percent' => [
            2,
            5000,
            20,
        ];
    }

    /**
     * @dataProvider provideDiscount
     */
    public function testCalculate(int $itemsCount, float $total, int $expected): void
    {
        $order = new Order($itemsCount, $total);
        self::assertSame($expected, $this->calculator->calculate($order));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new DiscountCalculator();
    }
}
