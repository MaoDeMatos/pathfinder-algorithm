<?php

// Error reporting off
// Avoid displaying PHP messages if a JSON is not readable
error_reporting(0);

// Base display
define("CONSOLE_RED", "\033[31m");
define("CONSOLE_YELLOW", "\033[33m");
define("CONSOLE_BLUE", "\033[34m");
define("CONSOLE_GREY", "\033[90m");
define("CONSOLE_GREEN", "\033[92m");
define("CONSOLE_DEFAULT_COLOR", "\033[39m");

define(
  'BLOCKED_POS_STR',
  PHP_EOL . CONSOLE_RED . "CANNOT STAND OR END ON A BLOCKED POSITION" . CONSOLE_DEFAULT_COLOR
    . PHP_EOL . PHP_EOL
);
define('END_STR', PHP_EOL . CONSOLE_GREEN . "PATH FOUND" . CONSOLE_DEFAULT_COLOR);
define('DISTANCE_STR', PHP_EOL . "Shortest distance from start");

// Class autoloader
spl_autoload_register(function ($c) {
  $classesDir = "./Classes/";
  // Search in the classes dir
  if (file_exists($classesDir . $c . '.php')) {
    require_once $classesDir . $c . '.php';
  }
});
