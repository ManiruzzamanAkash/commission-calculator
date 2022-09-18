<?php

declare(strict_types=1);

namespace App\CommissionTask\Abstracts;

use App\CommissionTask\Mapper\TransactionItem;

/**
 * Abstract Transaction.
 *
 * Set the TransactionItem.
 */
abstract class AbstractTransaction
{
    /**
     * TransactionItem instance.
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
