<?php

declare(strict_types=1);

namespace App;

use App\Contract\DiscountCalculatorInterface;
use App\Contract\OrderInterface;

class DiscountCalculator implements DiscountCalculatorInterface
{
    public function calculate(OrderInterface $order): int
    {
        if ($order->getItemsCount() < 2) {
            return 0;
        }

        if ($order->getTotal() >= 50 && $order->getTotal() < 100) {
            return 5;
        }

        if ($order->getTotal() >= 100 && $order->getTotal() < 1000) {
            return 10;
        }

        if ($order->getTotal() >= 1000 && $order->getTotal() < 5000) {
            return 15;
        }

        if ($order->getTotal() >= 5000) {
            return 20;
        }

        return 0;
    }
}
