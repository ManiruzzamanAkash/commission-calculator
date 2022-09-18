<?php

declare(strict_types=1);

namespace App\CommissionTask\Currency;

use App\CommissionTask\Traits\SingletonTrait;

/**
 * Currency Container class.
 *
 * We use this just for storing our currencies in Memory.
 */
class CurrencyContainer
{
    use SingletonTrait;

    /**
     * Get all currencies.
     *
     * @var array<Currency> Get the list of currencies data
     */
    public array $currencies;

    /**
     * Add new currency to the container.
     *
     * @param Currency $currency Currency object
     *
     * @return self Current class instance
     */
    public function add(Currency $currency): self
    {
        if (empty($this->currencies)) {
            $this->currencies = [];
        }

        if (!isset($this->currencies[$currency->getCurrency()])) {
            $this->currencies[$currency->getCurrency()] = $currency;
        }

        return $this;
    }

    /**
     * Get a currency from the container.
     *
     * @param string $currencyName Passed currency
     *
     * @return Currency|null Currency
     */
    public function get(string $currencyName): ?Currency
    {
        return $this->currencies[$currencyName] ? $this->currencies[$currencyName] : null;
    }

    /**
     * Remove a currency from the container.
     *
     * @param string $currencyName currency name
     *
     * @return self container class instance
     */
    public function remove(string $currencyName): self
    {
        if (isset($this->currencies[$currencyName])) {
            unset($this->currencies[$currencyName]);
        }

        return $this;
    }
}
