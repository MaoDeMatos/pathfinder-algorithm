<?php
// Class autoloader
spl_autoload_register(function ($c) {
  $classesDir = "./Classes/";
  // Search in the classes dir
  if (file_exists($classesDir . $c . '.php')) {
    require_once $classesDir . $c . '.php';
  }
});
