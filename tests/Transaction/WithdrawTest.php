<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Transaction;

use App\CommissionTask\Mapper\TransactionItem;
use App\CommissionTask\Transaction\Withdraw\Withdraw;
use PHPUnit\Framework\TestCase;

class WithdrawTest extends TestCase
{
    /**
     * @param string $lineData transaction item line data
     * @param string $expected expected commission
     *
     * @dataProvider dataProviderForBusinessWithdrawTransaction
     */
    public function testGetWithdrawCommissionForBusiness(string $lineData, float $expected)
    {
        $transactionItemData = explode(',', $lineData);
        $transactionItem = new TransactionItem($transactionItemData);

        $withdraw   = new Withdraw($transactionItem);
        $commission = $withdraw->setCommissionFeeByClientType()->getCommission();

        $this->assertEquals($expected, $commission);
    }

    public function dataProviderForBusinessWithdrawTransaction(): array
    {
        // Withdraw for business client ==> 0.5%
        return [
            'Get withdraw commission business client of 500.00,EUR' => ['2016-01-10,2,business,withdraw,500.00,EUR', 2.5], // 0.5% * 500 = 2.5
            'Get withdraw commission for business client of 10000 EUR' => ['2016-01-10,2,business,withdraw,10000.00,EUR', 50.0], // 0.5% * 10000 = 50.0
        ];
    }
}
