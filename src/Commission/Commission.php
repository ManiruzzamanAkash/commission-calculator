<?php

declare(strict_types=1);

namespace App\CommissionTask\Commission;

/**
 * Commission calculation helper.
 *
 * Helper methods related to commission calculation.
 */
class Commission
{
    /**
     * Get commission from transaction amount and commission fee.
     *
     * @param float $transactionAmount transaction amount
     * @param float $commissionFee     commission fee
     *
     * @return float commission amount
     */
    public static function calculate(float $transactionAmount, float $commissionFee): float
    {
        if ($commissionFee === 0) {
            return 0;
        }

        return ($transactionAmount * $commissionFee) / 100;
    }
}
