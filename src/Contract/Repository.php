<?php

declare(strict_types=1);

namespace App\Contract;

interface Repository
{
    public function all(): array;
    public function find(int $id): ?Entity;
    public function insert(Entity $entity): void;
    public function update(int $id, Entity $entity): void;
    public function delete(int $id): void;
}
