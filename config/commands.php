<?php

declare(strict_types=1);

use App\Command\CreateUser;
use App\Infrastructure\Persistence\Repository\UserInMemoryRepository;

return [
    CreateUser::class => function () {
        $inMemoryRepository = new UserInMemoryRepository();
        return new CreateUser($inMemoryRepository);
    },
];
