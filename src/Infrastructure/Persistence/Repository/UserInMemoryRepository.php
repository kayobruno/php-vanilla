<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Repository;

use App\Contract\Entity;
use App\Contract\Repository;

class UserInMemoryRepository implements Repository {

    private array $data = [];
    private int $lastId = 0;

    public function generateId(): int {
        return ++$this->lastId;
    }

    public function all(): array {
        return $this->data;
    }

    public function find(int $id): ?Entity {
        return $this->data[$id] ?? null;
    }

    public function insert(Entity $entity): void {
        $this->data[$this->generateId()] = $entity;
    }

    public function update(int $id, Entity $entity): void {
        if (isset($this->data[$id])) {
            $this->data[$id] = $entity;
        }
    }

    public function delete(int $id): void {
        unset($this->data[$id]);
    }
}
