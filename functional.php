<?php

require_once 'config.php';

echo PHP_EOL
  . CONSOLE_GREEN . "Start is GREEN" . CONSOLE_DEFAULT_COLOR
  . " - " . CONSOLE_YELLOW . "End is YELLOW" . CONSOLE_DEFAULT_COLOR
  . " - " . CONSOLE_GREY . "Blocked positions are GREY" . CONSOLE_DEFAULT_COLOR . ""
  . PHP_EOL;

echo "The algorithm can only go on 1s"
  . PHP_EOL . "It cannot go on 0s"
  . PHP_EOL . "It already went on 3s" . PHP_EOL;

// Setting up the matrix
$matrix = new Matrix();
$file =
  isset($argv[1]) && !empty($argv[1])
  ? strval($argv[1])
  : '';

if ($file !== '') {
  if ($temp = checkJsonFile($file, $matrix)) {
    $matrix = $temp;
    echo PHP_EOL . "MAP EXTRACTED FROM A JSON FILE" . PHP_EOL;
  } else {
    echo PHP_EOL . CONSOLE_RED . "INVALID FILE FORMAT"
      . PHP_EOL . "(SEE THE README FILE)"
      . CONSOLE_DEFAULT_COLOR . PHP_EOL;
    exit;
  }
} else {
  randomMatrix($matrix);
}

print_r(findPath($matrix, $matrix->getInitialPos(), $matrix->getFinalPos()));

$matrix->display();

// Main algorithm function
function findPath(Matrix $matrix, array $initialPos, array $finalPos) {
  $directions = [
    [-1, 0],
    [1, 0],
    [0, -1],
    [0, 1],
  ];

  $map = $matrix->getMap();
  $q = [[...$initialPos, 0, []]];

  // If Start or Finish positions are blocked paths
  if ($map[$initialPos[0]][$initialPos[1]] == 0 || $map[$finalPos[0]][$finalPos[1]] == 0) {
    return BLOCKED_POS_STR;
  } else {
    $map[$initialPos[0]][$initialPos[1]] = 3;
    $matrix->setMap($map);
  }

  // While $q is not empty
  while (count($q)) {
    [$currX, $currY, $distance] = array_shift($q);

    // If at the end position
    if ([$currX, $currY] == [$finalPos[0], $finalPos[1]]) {
      $map[$currX][$currY] = 3;
      $matrix->setMap($map);

      return END_STR . DISTANCE_STR . " : " . $distance . PHP_EOL;
    }

    foreach ($directions as [$dX, $dY]) {
      $nextX = $currX + $dX;
      $nextY = $currY + $dY;

      // If navigable position
      if (
        isset($map[$nextX][$nextY])
        && !empty($map[$nextX][$nextY])
        && $map[$nextX][$nextY] == 1
      ) {
        $map[$nextX][$nextY] = 3;
        $matrix->setMap($map);
        $q[] = [$nextX, $nextY, $distance + 1];
      }
    }
  }
  return PHP_EOL
    . CONSOLE_RED . "COULD NOT FIND A WAY TO THE END" . CONSOLE_DEFAULT_COLOR
    . PHP_EOL . PHP_EOL;
}

function checkJsonFile(string $file, Matrix $matrix): ?Matrix {
  if (isset($file) && !empty($file)) {
    $map = json_decode(file_get_contents($file), true);
    $map = $map[array_key_first($map)];

    $chars = [];

    // Find the start and the end of the path in the JSON file
    for ($i = 0; $i < count($map); $i++) {
      for ($j = 0; $j < count($map[$i]); $j++) {
        $chars[] = strtolower($map[$i][$j]);
        switch (strtolower($map[$i][$j])) {
          case 's':
            $matrix->setInitialPos([$i, $j]);
            $map[$i][$j] = 1;
            break;

          case 'e':
            $matrix->setFinalPos([$i, $j]);
            $map[$i][$j] = 1;
            break;

          default:
            break;
        }
      }
    }

    if (array_search("s", $chars) && array_search("e", $chars)) {
      // Fill the matrix with the JSON file content
      return $matrix->setMap($map);
    }
  }
  return null;
}

function randomMatrix($matrix): Matrix {
  $x = 12;
  $y = 10;
  $matrix->setSize($x, $y)
    ->setInitialPos([rand(0, $y - 1), rand(0, $x - 1)])
    ->setFinalPos([rand(0, $y - 1), rand(0, $x - 1)]);

  echo PHP_EOL . "MAP GENERATED RANDOMLY" . PHP_EOL;

  $gen = new MatrixGenerator();
  return $gen->generate($matrix);
}
