<?php

namespace Sashalenz\WiretableMoneyBundle\Fields;

use Sashalenz\Wiretable\Components\Fields\Field;

class MoneyField extends Field
{
    public bool $nullable = false;

    public function render()
    {
        return view('wiretable-money-bundle::money-field');
    }
}
