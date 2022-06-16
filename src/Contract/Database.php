<?php

declare(strict_types=1);

namespace App\Contract;

interface Database
{
    public function connect(): void;
}
