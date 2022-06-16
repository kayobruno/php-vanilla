<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Contract\Entity;
use App\Contract\Repository;
use App\Infrastructure\Persistence\Database\MySQL;
use PDO;

class UserMySQLRepository implements Repository
{
    private ?PDO $conn;

    public function __construct()
    {
        /** @var MySQL $databaseManagerSingleton */
        $databaseManagerSingleton = MySQL::getInstance();
        $this->conn = $databaseManagerSingleton->getConn();
    }

    public function all(): array
    {
        $statement = $this->conn->prepare("SELECT * FROM users");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function insert(Entity $entity): void
    {
        $params = serialize($entity);
        $placeholdersToParams = $this->prepareParams($params);

        $stmt= $this->conn->prepare("INSERT INTO users (`name`, `email`) VALUES ({$placeholdersToParams})");
        $stmt->execute(array_values($params));
    }

    public function update(int $id, Entity $entity): void
    {
        $params = serialize($entity);
        $params['id'] = $id;

        $stmt = $this->conn->prepare("UPDATE users SET name=:name, email=:email WHERE id=:id");
        $stmt->execute($params);
    }

    public function delete(int $id): void
    {
        $stmt= $this->conn->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
    }

    private function prepareParams(array $params): string
    {
        return implode(', ', array_fill(0, count($params), '?'));
    }
}
