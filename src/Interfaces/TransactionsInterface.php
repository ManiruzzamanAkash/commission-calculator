<?php

declare(strict_types=1);

namespace App\CommissionTask\Interfaces;

use App\CommissionTask\Mapper\TransactionItem;

/**
 * Interface Transactions.
 */
interface TransactionsInterface
{
    /**
     * Process single Transaction item.
     */
    public function process(TransactionItem $transactionItem): float;

    /**
     * Process bulk Transaction items.
     */
    public function processBulk(): void;
}
