<?php

declare(strict_types=1);

namespace App\CommissionTask\Transaction;

use App\CommissionTask\Currency\Calculator;
use App\CommissionTask\Interfaces\TransactionsInterface;
use App\CommissionTask\Mapper\TransactionItem;
use App\CommissionTask\Mapper\TransactionItems;
use App\CommissionTask\Traits\MoneyFormatterTrait;
use App\CommissionTask\Transaction\Deposit\Deposit;
use App\CommissionTask\Transaction\Withdraw\Withdraw;
use Exception;
use Throwable;

/**
 * Transaction Processor class.
 *
 * Handles TransactionItems[] and process it.
 */
class Transaction implements TransactionsInterface
{
    use MoneyFormatterTrait;

    /**
     * Transaction responses.
     */
    public array $responses;

    /**
     * TransactionItems instance.
     */
    public TransactionItems $transactionItems;

    /**
     * Class constructor.
     */
    public function __construct(TransactionItems $transactionItems)
    {
        $this->responses = [];
        $this->transactionItems = $transactionItems;
    }

    /**
     * Process single Transaction item to get the commission.
     *
     * @param TransactionItem $transactionItem transaction item instance
     *
     * @return float processed commission amount
     *
     * @throws Exception
     */
    public function process(TransactionItem $transactionItem): float
    {
        $amount = 0;

        try {
            switch ($transactionItem->transactionType) {
                case 'deposit':
                    $deposit = new Deposit($transactionItem);
                    $amount = $deposit->setDefaultCommissionFee()->getCommission();
                    break;

                case 'withdraw':
                    $withdraw = new Withdraw($transactionItem);
                    $amount = $withdraw->setCommissionFeeByClientType()->getCommission();
                    break;

                default:
                    break;
            }

            return $amount;
        } catch (Throwable $th) {
            throw $th;
        }
    }

    /**
     * Process bulk transactions.
     *
     * It will handle a list of transactions.
     * For now, it's just processing the commission amount and
     * then, it'll just store the commission to responses[]
     *
     * @return void processes the transaction items
     *
     * @throws Exception
     */
    public function processBulk(): void
    {
        try {
            $transactions = $this->transactionItems->getItems();
            foreach ($transactions as $transaction) {
                // Convert transaction amount to base currency
                $transaction->amount = Calculator::convertTransactionAmountToBaseCurrency($transaction);

                // Process single transaction and get the commission.
                $commission = $this->process($transaction);

                // Revert back the currency to it's own currency.
                $commission = Calculator::convertCommissionAmountToOwnCurrency($transaction, $commission);

                // Add in our responses[] list for next processing
                $this->responses[] = $this->format($commission, $transaction->currency);
            }
        } catch (Exception $e) {
            throw new Exception('Something went wrong calculating. Error:'.$e->getMessage(), 400);
        }
    }
}
