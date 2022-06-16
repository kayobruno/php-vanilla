<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Database;

use App\Contract\Database;
use PDO;

final class MySQL extends DatabaseManagerSingleton implements Database
{
    private ?PDO $conn = null;
    private array $options = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
    ];

    private function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $dsn = $this->buildDsn();

        $this->conn = new PDO($dsn, $user, $pass, $this->options);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConn(): ?PDO
    {
        return $this->conn;
    }

    private function buildDsn(): string
    {
        $database = getenv('DB_DATABASE');
        $port = (int) getenv('DB_PORT');
        $host = getenv('DB_HOST');

        return "mysql:dbname={$database};host={$host};port={$port}";
    }
}
