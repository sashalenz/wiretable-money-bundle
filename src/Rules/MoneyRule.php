<?php

namespace Sashalenz\WiretableMoneyBundle\Rules;

use Illuminate\Contracts\Validation\Rule;
use Money\Money;

class MoneyRule implements Rule
{
    private ?float $min;
    private ?float $max;

    public function __construct(?float $min = null, ?float $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function passes($attribute, $value): bool
    {
        if (!$value instanceof Money) {
            return false;
        }

        if ($this->min && $value->lessThan(new Money($this->min * 100, $value->getCurrency()))) {
            return false;
        }

        if ($this->max && $value->greaterThan(new Money($this->max * 100, $value->getCurrency()))) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return __('validation.between.numeric', [
            'min' => $this->min,
            'max' => $this->max
        ]);
    }
}
