<?php

declare(strict_types=1);

namespace App\Discount;

use App\Contract\DiscountCalculatorInterface;
use App\Contract\DiscountRuleInterface;
use App\Contract\OrderInterface;

class DiscountCalculator implements DiscountCalculatorInterface
{
    /** @var DiscountRuleInterface[] */
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    public function calculate(OrderInterface $order): int
    {
        if (empty($this->rules)) {
            return 0;
        }

        foreach ($this->rules as $rule) {
            if (!$rule->isQualified($order)) {
                continue;
            }

            return $rule->getDiscount();
        }

        return 0;
    }
}
