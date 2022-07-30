<?php

declare(strict_types=1);

use App\Application;
use App\Command\CreateUser;
use Psr\Container\ContainerInterface;

if (php_sapi_name() !== 'cli') {
    exit;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(function () {
    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

    try {
        /** @var Application $app */
        $app = $container->get(Application::class);
        $app->addCommand($container->get(CreateUser::class));

        $app->run();
    } catch (\Exception $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
})();
