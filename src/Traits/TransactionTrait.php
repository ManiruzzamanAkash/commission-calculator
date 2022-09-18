<?php

declare(strict_types=1);

namespace App\CommissionTask\Traits;

use App\CommissionTask\Mapper\TransactionItem;

/**
 * Transaction Trait.
 *
 * Handles the transaction related classes like Withdraw, Deposit.
 */
trait TransactionTrait
{
    /**
     * Transaction amount instance.
     */
    public TransactionItem $transactionItem;

    /**
     * Trait constructor.
     */
    public function __construct(TransactionItem $transactionItem)
    {
        $this->transactionItem = $transactionItem;
    }
}
