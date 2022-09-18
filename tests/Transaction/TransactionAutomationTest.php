<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Transaction;

use App\CommissionTask\Currency\Currency;
use App\CommissionTask\Currency\CurrencyContainer;
use App\CommissionTask\File\CsvReader;
use App\CommissionTask\Mapper\TransactionItems;
use App\CommissionTask\Transaction\Transaction;
use PHPUnit\Framework\TestCase;

class TransactionAutomationTest extends TestCase
{
    public string $fileName;

    /**
     * Add a csv file before starting the processes.
     *
     * @return void
     */
    protected function setup(): void
    {
        $this->fileName = 'sample.csv';

        // open csv file for writing
        $f = fopen($this->fileName, 'w');

        if ($f === false) {
            die('Error opening the file ' . $this->fileName);
        }

        // write each row at a time to a file
        foreach ($this->getTestData() as $row) {
            fputcsv($f, $row);
        }

        // close the file
        fclose($f);
    }

    /**
     * Delete the file after processing.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        if (!unlink($this->fileName)) {
            throw new \Exception('Something went wrong. File can not being deleted.');
        }
    }

    /**
     * test
     */
    public function testGetCommissionFeesCsvFile()
    {
        $csvData = file_get_contents($this->fileName);
        $csvReader = new CsvReader();
        $csvReader->setRows($csvData);

        /**
         * Add some currencies for testing.
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

        $this->assertEquals(
            $this->getTestResult(),
            $transaction->responses
        );
    }

    /**
     * Get test data.
     *
     * @return array Test datasets for the CSV file
     */
    public function getTestData(): array
    {
        return [
            ['2014-12-31', 4, 'private', 'withdraw', 1200.00, 'EUR'],
            ['2015-01-01', 4, 'private', 'withdraw', 1000.00, 'EUR'],
            ['2016-01-05', 4, 'private', 'withdraw', 1000.00, 'EUR'],
            ['2016-01-05', 1, 'private', 'deposit', 200.00, 'EUR'],
            ['2016-01-06', 2, 'business', 'withdraw', 300.00, 'EUR'],
            ['2016-01-06', 1, 'private', 'withdraw', 30000, 'JPY'],
            ['2016-01-07', 1, 'private', 'withdraw', 1000.00, 'EUR'],
            ['2016-01-07', 1, 'private', 'withdraw', 100.00, 'USD'],
            ['2016-01-10', 1, 'private', 'withdraw', 100.00, 'EUR'],
            ['2016-01-10', 2, 'business', 'deposit', 10000.00, 'EUR'],
            ['2016-01-10', 3, 'private', 'withdraw', 1000.00, 'EUR'],
            ['2016-02-15', 1, 'private', 'withdraw', 300.00, 'EUR'],
            ['2016-02-19', 5, 'private', 'withdraw', 3000000, 'JPY']
        ];
    }

    /**
     * Get test result set for that CSV file.
     *
     * @return array test array result set
     */
    public function getTestResult(): array
    {
        return [
            0.60,
            3.00,
            0.00,
            0.06,
            1.50,
            0,
            0.69,
            0.30,
            0.30,
            3.00,
            0.00,
            0.00,
            8612,
        ];
    }
}
