<?php

declare(strict_types=1);

namespace App\CommissionTask\Tests\Core;

use App\CommissionTask\Core\DateHelper;
use PHPUnit\Framework\TestCase;

class DateHelperTest extends TestCase
{
    /**
     * @param string $date
     * @param int    $expectation
     *
     * @dataProvider dataProviderForWeekNoTesting
     */
    public function testGetWeekNo(string $date, int $expectation)
    {
        $this->assertEquals(
            $expectation,
            DateHelper::getWeekNo($date)
        );
    }

    /**
     * @param string $date
     * @param int    $expectation
     *
     * @dataProvider dataProviderForWeekNoWithYearTesting
     */
    public function testGetWeekNoAppendingPreviousYear(string $date, int $expectation)
    {
        $this->assertEquals(
            $expectation,
            DateHelper::getWeekNo($date, true)
        );
    }

    public function dataProviderForWeekNoTesting(): array
    {
        return [
            'Get 2014-12-29 (Monday) week no' => ['2014-12-29', 1],
            'Get 2014-12-30 (Tuesday) week no' => ['2014-12-30', 1],
            'Get 2014-12-31 (Wednesday) week no' => ['2014-12-31', 1],
            'Get 2015-01-01 (Thursday) week no' => ['2015-01-01', 1],
            'Get 2015-01-02 (Friday) week no' => ['2015-01-02', 1],
            'Get 2015-01-03 (Saturday) week no' => ['2015-01-03', 1],
            'Get 2015-01-04 (Sunday) week no' => ['2015-01-04', 1],

            // Starts new week
            'Get 2015-01-05 (Monday) week no' => ['2015-01-05', 2],
            'Get 2015-01-06 (Tuesday) week no' => ['2015-01-06', 2],
            'Get 2015-01-12 (Tuesday) week no' => ['2015-01-12', 3],
        ];
    }

    public function dataProviderForWeekNoWithYearTesting(): array
    {
        return [
            'Get 2014-12-29 (Monday) week no' => ['2014-12-29', 2016],
            'Get 2014-12-30 (Tuesday) week no' => ['2014-12-30', 2016],
            'Get 2014-12-31 (Wednesday) week no' => ['2014-12-31', 2016],
            'Get 2015-01-01 (Thursday) week no' => ['2015-01-01', 2016],
            'Get 2015-01-02 (Friday) week no' => ['2015-01-02', 2016],
            'Get 2015-01-03 (Saturday) week no' => ['2015-01-03', 2016],
            'Get 2015-01-04 (Sunday) week no' => ['2015-01-04', 2016],

            // Starts new week
            'Get 2015-01-05 (Monday) week no' => ['2015-01-05', 2017],
            'Get 2015-01-06 (Tuesday) week no' => ['2015-01-06', 2017],
            'Get 2015-01-12 (Tuesday) week no' => ['2015-01-12', 2018],
        ];
    }
}
