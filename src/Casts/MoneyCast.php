<?php

namespace Sashalenz\WiretableMoneyBundle\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;
use Money\Currency;
use Money\Money;

class MoneyCast implements CastsAttributes
{
    protected ?string $currency = null;

    public function __construct(?string $currency = null)
    {
        $this->currency = $currency;
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed|Money
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return null;
        }

        return new Money((int) $value, new Currency((string) $this->getCurrencyValue($model, $attributes)));
    }

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return array|mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_array($value) && array_key_exists('amount', $value) && array_key_exists('currency', $value)) {
            $value = new Money($value['amount'], new Currency($value['currency']));
        }

        if (!$value instanceof Money) {
            throw new InvalidArgumentException('The given value is not an Money instance.');
        }

        if (array_key_exists('currency', $attributes)) {
            return [
                $key => $value->getAmount(),
                'currency' => $value->getCurrency()
            ];
        }

        return [$key => $value->getAmount()];
    }

    private function getCurrencyValue($model, $attributes)
    {
        if (is_null($this->currency)) {
            Config::get('app.currency');
        }

        if (array_key_exists($this->currency, $attributes)) {
            return $model->{$this->currency};
        }

        return $this->currency;
    }
}
