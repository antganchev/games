<?php

use Controllers\BaseController;
use DI\DependencyInjection;

require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../src/autoload.php";

$di = DependencyInjection::getDI();


require_once __DIR__ . "/../config/services.php";
require_once __DIR__ . "/../config/routes.php";

BaseController::dispatch($di, $selectedRoute);