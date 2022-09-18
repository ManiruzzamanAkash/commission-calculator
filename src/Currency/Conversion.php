<?php

declare(strict_types=1);

namespace App\CommissionTask\Currency;

/**
 * Currency Conversion.
 */
class Conversion
{
    /**
     * From currency.
     *
     * @var Currency from currency instance
     */
    public Currency $from;

    /**
     * To currency.
     *
     * @var Currency to currency instance
     */
    public Currency $to;

    /**
     * Class constructor.
     *
     * @param Currency $from From currency needs to convert
     * @param Currency $to   Converted to this currency
     */
    public function __construct(Currency $from, Currency $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Convert currency from one currency to another.
     *
     * @param float $amount amount needs to convert
     *
     * @return float converted amount
     */
    public function convert(float $amount): float
    {
        // No need to process if both currencies are same.
        if ($this->from->getCurrency() === $this->to->getCurrency()) {
            return $amount;
        }

        $fromRate = ConversionRate::get($this->from->getCurrency());
        $toRate = ConversionRate::get($this->to->getCurrency());

        return Calculator::changeRate($amount, $fromRate, $toRate);
    }
}
