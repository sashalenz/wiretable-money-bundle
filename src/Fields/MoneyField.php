<?php

namespace Sashalenz\WiretableMoneyBundle\Fields;

use Sashalenz\Wiretable\Components\Fields\Field;

class MoneyField extends Field
{
    public bool $nullable = false;
    public array $currencies = [];

    public function setCurrencies(array $currencies): self
    {
        $this->currencies = $currencies;

        return $this;
    }

    public function render()
    {
        return view('wiretable-money-bundle::money-field');
    }
}
