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

(function() {
    /** @var ContainerInterface $container */
    $container = require 'config/container.php';

})();
