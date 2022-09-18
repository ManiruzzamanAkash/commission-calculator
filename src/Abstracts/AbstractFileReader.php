<?php

declare(strict_types=1);

namespace App\CommissionTask\Abstracts;

/**
 * Abstract file reader class.
 *
 * Reads the file and get/set rows.
 */
abstract class AbstractFileReader
{
    /**
     * File name.
     */
    protected $file;

    /**
     * Set a file.
     *
     * @param mixed $file file name
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }

    /**
     * Get a file.
     *
     * @return mixed get the file
     */
    public function getFile(): mixed
    {
        return $this->file;
    }

    /**
     * Get file rows.
     *
     * @return array get rows as array
     */
    abstract public function getRows(): array;

    /**
     * Set file rows.
     *
     * @param string $data rows that will be pushed to rows[]
     *
     * @return self current instance
     */
    abstract public function setRows(string $data): self;
}
