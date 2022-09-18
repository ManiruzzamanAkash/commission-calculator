<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Currency;

use App\CommissionTask\Currency\ConversionRate;
use PHPUnit\Framework\TestCase;

class ConversionRateTest extends TestCase
{
    /**
     * @test
     */
    public function testGetConversion()
    {
        $this->assertEquals(
            1,
            ConversionRate::get('EUR')
        );

        $this->assertEquals(
            129.53,
            ConversionRate::get('JPY')
        );
    }
}
