<?php

declare(strict_types=1);

namespace App\Contract;

interface DiscountCalculatorInterface
{
    public function calculate(OrderInterface $order): int;
}
