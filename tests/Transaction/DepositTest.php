<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Transaction;

use App\CommissionTask\Mapper\TransactionItem;
use App\CommissionTask\Transaction\Deposit\Deposit;
use PHPUnit\Framework\TestCase;

class DepositTest extends TestCase
{
    /**
     * @param string $lineData transaction item line data
     * @param string $expected expected commission
     *
     * @dataProvider dataProviderForDepositTransaction
     */
    public function testGetDepositCommission(string $lineData, float $expected)
    {
        $transactionItemData = explode(',', $lineData);
        $transactionItem = new TransactionItem($transactionItemData);

        $deposit = new Deposit($transactionItem);
        $commission = $deposit->setDefaultCommissionFee()->getCommission();

        $this->assertEquals($expected, $commission);
    }

    public function dataProviderForDepositTransaction(): array
    {
        // Deposit for all type client ==> 0.03%
        return [
            'Get deposit commission for private client of 500.00 EUR' => ['2016-01-10,2,private,deposit,500.00,EUR', 0.15], // 0.03 * 500 = 0.15
            'Get deposit commission for business client of 10000.00 EUR' => ['2016-01-10,2,business,deposit,10000.00,EUR', 3.0], // 0.03 * 10000 = 3.0
        ];
    }
}
