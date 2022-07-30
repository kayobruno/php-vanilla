<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Database;

class DatabaseManagerSingleton
{
    protected static ?self $instance = null;

    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
