<?php

use App\CommissionTask\Currency\CurrencyContainer;
use App\CommissionTask\Currency\Currency;
use App\CommissionTask\File\CsvReader;
use App\CommissionTask\Mapper\TransactionItems;
use App\CommissionTask\Transaction\Transaction;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Get the filename form cmd and run.
 *
 * @example
 * ```sh
 * php script.php
 * input.csv
 * ```
 */
$fileName = fgets(STDIN);

try {
    // Handle File from terminal
    $csvData = file_get_contents(__DIR__ . '/' . trim($fileName));
    $csvReader = new CsvReader();
    $csvReader->setRows($csvData);

    /**
     * Add some currencies.
     *
     * We can also process this from Currencies class.
     * To make the process simpler we've added it
     */
    $baseCurrency = new Currency();
    $baseCurrency->setCurrency('EUR');

    $currencyUsd = new Currency();
    $currencyUsd->setCurrency('USD');

    $currencyJpy = new Currency();
    $currencyJpy->setCurrency('JPY')
        ->setDecimals(0);

    $currencyData = CurrencyContainer::getInstance();
    $currencyData->add($baseCurrency)
        ->add($currencyUsd)
        ->add($currencyJpy);

    // Map transaction data into TransactionItem object.
    $transactionItems = new TransactionItems();
    $transactionItems->setItems($csvReader->getRows());

    // Process transaction
    $transaction = new Transaction($transactionItems);
    $transaction->processBulk();
    echo implode("\r\n", $transaction->responses);
} catch (\Exception $e) {
    echo "Please give a valid file name. File does not exists.";
}
