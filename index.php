<?php

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

define('PAGE', ROOT . 'page' . DIRECTORY_SEPARATOR);
define('LIBS', APP . 'libs' . DIRECTORY_SEPARATOR);

// load application config (error reporting etc.)
require_once APP . '/config/config.php';

// FOR DEVELOPMENT: this loads PDO-debug, a simple function that shows the SQL query (when using PDO).
// If you want to load pdoDebug via Composer, then have a look here: https://github.com/panique/pdo-debug
require_once APP . '/libs/pdo-debug.php';

// load application class
require_once APP . '/core/application.php';
require_once APP . '/core/controller.php';

// start the application
$app = new Application();
