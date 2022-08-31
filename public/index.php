<?php

require_once '../autoload.php';

use App\Core\Database;
use App\Core\Router;

Database::init();

require_once '../app/config/routes.php';

Router::resolve();
