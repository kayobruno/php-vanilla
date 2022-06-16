<?php

declare(strict_types=1);

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->useAutowiring(false)->useAnnotations(false);

$containerBuilder
    ->addDefinitions(require __DIR__ . '/app.php')
    ->addDefinitions(require __DIR__ . '/commands.php');

return $containerBuilder->build();
