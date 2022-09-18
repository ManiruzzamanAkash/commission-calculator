<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Currency;

use App\CommissionTask\Currency\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    private Currency $currency;

    /**
     * Add the currencies to the Currency Container.
     */
    protected function setup(): void
    {
        $this->currency = new Currency();
    }

    /**
     * @test
     */
    public function testSetAndGetCurrency()
    {
        $this->currency->setCurrency('XYZ')
            ->setDecimals(4);

        $this->assertEquals(
            'XYZ',
            $this->currency->getCurrency()
        );

        $this->assertEquals(
            4,
            $this->currency->getDecimals()
        );
    }
}
