<?php

declare(strict_types=1);

namespace App\CommissionTask\Transaction\Deposit;

use App\CommissionTask\Commission\Commission;
use App\CommissionTask\Interfaces\CommissionInterface;
use App\CommissionTask\Traits\CommissionTrait;
use App\CommissionTask\Traits\TransactionTrait;

/**
 * Deposit type transaction class.
 *
 * Handles TransactionItem instance and process it.
 */
class Deposit implements CommissionInterface
{
    use TransactionTrait;
    use CommissionTrait;

    /**
     * Get default commission fee for Deposit transaction.
     *
     * @var float default commission fee
     */
    public const DEPOSIT_COMMISSION_FEE = 0.03;

    /**
     * Get commission amount for Deposit transaction.
     *
     * @return float get calculated commission
     */
    public function getCommission(): float
    {
        return Commission::calculate($this->transactionItem->amount, $this->commissionFee);
    }

    /**
     * Set default commission fee for all type of deposit.
     *
     * @return self current class instance
     */
    public function setDefaultCommissionFee(): self
    {
        $this->setCommissionFee(self::DEPOSIT_COMMISSION_FEE);

        return $this;
    }
}
