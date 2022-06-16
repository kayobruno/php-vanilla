<?php

declare(strict_types=1);

namespace Tests\Infrastructure\Persistence\Database;

use App\Infrastructure\Persistence\Database\DatabaseManagerSingleton;
use PHPUnit\Framework\TestCase;

class DatabaseManagerSingletonTest extends TestCase
{
    /**
     * @test
     */
    public function databaseManagerSingleton_ShouldCreateOnlyOneInstance(): void
    {
        $instanceOne = DatabaseManagerSingleton::getInstance();
        $instanceTwo = DatabaseManagerSingleton::getInstance();

        $this->assertEquals($instanceOne, $instanceTwo);
    }
}
