<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '192.168.1.101');
define('DB_NAME', 'pages');
define('DB_USER', 'root');
define('DB_PASS', 'my-secret-pw');
