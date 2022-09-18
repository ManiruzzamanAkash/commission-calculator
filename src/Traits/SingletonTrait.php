<?php

declare(strict_types=1);

namespace App\CommissionTask\Traits;

/**
 * Singleton trait.
 *
 * Make a class Singletonable using this trait.
 */
trait SingletonTrait
{
    /**
     * Singleton Instance.
     *
     * @var self
     */
    private static $instance;

    /**
     * Private Constructor.
     *
     * We can't use the constructor to create an instance of the class
     *
     * @return void
     */
    private function __construct()
    {
        // Don't do anything, we don't want to be initialized
    }

    /**
     * Get the singleton instance.
     *
     * @return $this
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * Singleton instance.
     *
     * @return void
     */
    private function __clone()
    {
        // Don't do anything, we don't want to be cloned
    }
}
