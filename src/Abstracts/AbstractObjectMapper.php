<?php

declare(strict_types=1);

namespace App\CommissionTask\Abstracts;

/**
 * Abstract Object mapper.
 *
 * Maps an array with an object.
 */
abstract class AbstractObjectMapper
{
    /**
     * Get column mapper key wise index.
     *
     * @return array Key wise column mappings
     */
    abstract protected function getColumnMapper(): array;
}
