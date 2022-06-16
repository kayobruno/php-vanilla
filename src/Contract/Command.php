<?php

declare(strict_types=1);

namespace App\Contract;

interface Command
{
    public function execute(): void;
}
