<?php

declare(strict_types=1);

namespace App;

use App\Contract\Command;

class Application
{
    private array $commands = [];

    public function run(): void
    {
        try {
            $commandName = $this->extractCommandName();
            if (!isset($this->commands[$commandName])) {
                throw new \InvalidArgumentException('Command don`t exists!');
            }

            $this->commands[$commandName]->execute();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function addCommand(Command $command): void
    {
        $this->commands[$command::class] = $command;
    }

    private function extractCommandName(): string
    {
        $argv = $_SERVER['argv'];
        $hasCommandName = isset($argv[1]);
        if (!$hasCommandName) {
            throw new \InvalidArgumentException('Command name is required');
        }

        $namespace = "App\\Command\\";

        return $namespace . $argv[1];
    }
}
