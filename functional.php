<?php

require_once 'autoload.php';

$map = json_decode(file_get_contents("./data.json"));

$matrix = new Matrix();
$matrix->setSize(12, 12)->setMap($map->simple);

// $gen = new MatrixGenerator();
// $matrix = $gen->fill($matrix);

$matrix->display();

$initial = ['x' => 2, 'y' => 2];
$final = ['x' => 3, 'y' => 4];

$steps = 0;

print_r(
  findPath(
    // $matrix,
    $matrix->getInitialPos(),
    $final
  )
);

function findPath(
  // Matrix $map,
  array $initialPos,
  array $finalPos
) {
  global $steps;
  $nextPos = $initialPos;

  if ($initialPos == $finalPos) {
    return PHP_EOL . "\033[92mEND\033[0m";
  }

  if ($initialPos !== $finalPos) {
    // print_r($initialPos);
    // print_r($finalPos);

    if (isBigger($initialPos["x"], $finalPos["x"])) {
      $nextPos["x"] = $initialPos["x"] - 1;
      $steps++;
    } elseif (isBigger($finalPos["x"], $initialPos["x"])) {
      $nextPos["x"] = $initialPos["x"] + 1;
      $steps++;
    }

    if (isBigger($initialPos["y"], $finalPos["y"])) {
      $nextPos["y"] = $initialPos["y"] - 1;
      $steps++;
    } elseif (isBigger($finalPos["y"], $initialPos["y"])) {
      $nextPos["y"] = $initialPos["y"] + 1;
      $steps++;
    }

    if (($nextPos["x"] || $nextPos['y']) == 0) {
      return PHP_EOL . "Impossible de passer ";
    }

    // print_r($nextPos);

    findPath($nextPos, $finalPos);
  }

  return PHP_EOL . "Steps count : " . $steps;
}

/*
function display($array) {
  for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array[$i]); $j++) {
      if (!$array[$i][$j]) {
        echo "\033[31m " . $array[$i][$j] . "\033[0m";
      } else echo " " . $array[$i][$j];
    }
    echo PHP_EOL;
  }
}
*/

function isBigger($a, $b) {
  if ($a > $b) {
    return true;
  } else {
    return false;
  }
}
