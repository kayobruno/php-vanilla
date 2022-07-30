<?php

declare(strict_types=1);

namespace App\Command;

use App\Contract\Command;
use App\Contract\Repository;
use App\Entity\User;

class CreateUser implements Command
{
    public function __construct(private Repository $repository)
    {
    }

    public function execute(): void
    {
        [$name, $email] = $this->getArgumentsToCreateUser();
        $user = new User(rand(1, 9999), $name, $email);
        $this->repository->insert($user);

        echo 'User Created!' . PHP_EOL;
    }

    private function getArgumentsToCreateUser(): array
    {
        $argv = $_SERVER['argv'];
        if (!isset($argv[2], $argv[3])) {
            throw new \InvalidArgumentException('All user fields are required!');
        }

        $name = $argv[2];
        $email = $argv[3];

        return [$name, $email];
    }
}
