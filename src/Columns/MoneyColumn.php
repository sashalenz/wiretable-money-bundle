<?php

namespace Sashalenz\WiretableMoneyBundle\Columns;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;
use Sashalenz\Wiretable\Components\Columns\Column;

class MoneyColumn extends Column
{
    public function renderIt($row) {
        $value = $row->{$this->getName()};

        if (is_null($value)) {
            return null;
        }

        $numberFormatter = new NumberFormatter('ru-RU', NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, new ISOCurrencies());

        return $moneyFormatter->format($value);
    }

    public function render()
    {
//
    }
}
