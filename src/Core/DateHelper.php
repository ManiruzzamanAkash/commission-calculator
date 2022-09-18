<?php

declare(strict_types=1);

namespace App\CommissionTask\Core;

use DateTime;

/**
 * Date helper class.
 *
 * Handles date related methods.
 */
class DateHelper
{
    /**
     * Get week no from date in a year.
     *
     * @param string $date       Date
     * @param bool   $appendYear $appendYear or not
     *                           If true, then works with previous year too
     *
     * @return int get week no
     */
    public static function getWeekNo(string $date, bool $appendYear = false): int
    {
        $date = new DateTime($date);
        $weekNo = (int) $date->format('W');

        if ($appendYear) {
            $weekNo += (int) $date->format('o');
        }

        return $weekNo;
    }
}
