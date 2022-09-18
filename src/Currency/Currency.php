<?php

declare(strict_types=1);

namespace App\CommissionTask\Currency;

/**
 * Currency class.
 */
class Currency
{
    /**
     * Get Base currency name.
     *
     * @var string
     */
    public const BASE_CURRENCY = 'EUR';

    /**
     * Currency name.
     *
     * @var string currency name
     */
    private string $currency;

    /**
     * Decimals for currency.
     *
     * @var int currency decimal point
     */
    private int $decimals = 2;

    /**
     * Get the value of currency name.
     *
     * @return string currency name
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Set the value of currency name.
     *
     * @param string $currency currency name
     *
     * @return self currency class instance
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get the value of decimals.
     *
     * @return int decimal point
     */
    public function getDecimals(): int
    {
        return $this->decimals;
    }

    /**
     * Set the value of decimals.
     *
     * @param int $decimal decimal point
     *
     * @return self currency class instance
     */
    public function setDecimals(int $decimals): self
    {
        $this->decimals = $decimals;

        return $this;
    }
}
