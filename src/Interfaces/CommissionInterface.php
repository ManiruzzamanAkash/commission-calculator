<?php

declare(strict_types=1);

namespace App\CommissionTask\Interfaces;

/**
 * Interface Commission.
 */
interface CommissionInterface
{
    /**
     * Get the commission amount.
     */
    public function getCommission(): float;
}
