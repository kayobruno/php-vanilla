<?php

namespace App\Entity;

use App\Contract\Entity;

class User implements Entity
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $email
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
