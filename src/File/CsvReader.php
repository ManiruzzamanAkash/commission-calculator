<?php

declare(strict_types=1);

namespace App\CommissionTask\File;

use App\CommissionTask\Abstracts\AbstractFileReader;

class CsvReader extends AbstractFileReader
{
    /**
     * Get CSV rows.
     */
    private array $rows;

    /**
     * Get rows.
     *
     * @return array get rows
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Set rows data by exploding new line.
     *
     * @param string $data rows data
     *
     * @return self current instance
     */
    public function setRows(string $data): self
    {
        $this->rows = explode("\n", $data);

        return $this;
    }
}
