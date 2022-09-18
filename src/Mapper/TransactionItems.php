<?php

declare(strict_types=1);

namespace App\CommissionTask\Mapper;

/**
 * TransactionItems mapper class.
 *
 * Makes $items from TransactionItem[]
 */
class TransactionItems
{
    /**
     * Transaction items.
     *
     * @var array<TransactionItem> items list array
     */
    private array $items;

    /**
     * Constructor class.
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * Get Mapped Transaction items.
     *
     * @return array<TransactionItem> items array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Set Mapped Transaction items.
     *
     * @return self current instance
     */
    public function setItems(array $transactionLines): self
    {
        foreach ($transactionLines as $transactionLine) {
            if (!empty($transactionLine)) {
                $transactionItemData = explode(',', $transactionLine);
                $this->items[] = new TransactionItem($transactionItemData);
            }
        }

        return $this;
    }
}
