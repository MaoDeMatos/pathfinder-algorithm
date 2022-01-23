<?php

require_once './config.php';

echo PHP_EOL
  . CONSOLE_BLUE . "Start is BLUE" . CONSOLE_DEFAULT_COLOR
  . " - " . CONSOLE_GREEN . "Path is GREEN" . CONSOLE_DEFAULT_COLOR . PHP_EOL
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
  if ($temp = checkJsonFile($matrix, $file)) {
    $matrix = $temp;
    echo PHP_EOL . "MAP EXTRACTED FROM A JSON FILE" . PHP_EOL;
  } else {
    echo PHP_EOL . CONSOLE_RED . "INVALID FILE FORMAT"
      . PHP_EOL . "(SEE THE README FILE)"
      . CONSOLE_DEFAULT_COLOR . PHP_EOL;
    exit;
  }
} else {
  $gen = new MatrixGenerator();
  $matrix = $gen->randomMatrix($matrix);
}

// Execute
printf("%s", findPath(
  $matrix,
  $matrix->getInitialPos(),
  $matrix->getFinalPos()
));

// Display final map, with shortest path and positions checked
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
  // Set the first element in queue :
  // We store its coordinates and the list of parent nodes
  // (Empty array for the starting node)
  $q = [
    [$initialPos, []]
  ];

  // If Start or Finish positions are blocked paths
  if ($map[$initialPos[0]][$initialPos[1]] == 0 || $map[$finalPos[0]][$finalPos[1]] == 0) {
    return BLOCKED_POS_STR;
  } else {
    $map[$initialPos[0]][$initialPos[1]] = 3;
    $matrix->setMap($map);
  }

  // While $q is not empty
  while (count($q)) {
    [$position, $path] = array_shift($q);
    [$currX, $currY] = $position;

    // If at the end position
    if ([$currX, $currY] == [$finalPos[0], $finalPos[1]]) {
      $map[$currX][$currY] = 3;
      $matrix->setMap($map)
        ->setShortestPath($path);

      return END_STR . DISTANCE_STR . " : " . count($path) . PHP_EOL;
    }

    $path[] = [$currX, $currY];

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

        $nextPosition = [$nextX, $nextY];

        $q[] = [$nextPosition, $path];
      }
    }
  }
  return PHP_EOL
    . CONSOLE_RED . "COULD NOT FIND A WAY TO THE END" . CONSOLE_DEFAULT_COLOR
    . PHP_EOL . PHP_EOL;
}

function checkJsonFile(Matrix $matrix, string $file): ?Matrix {
  $data = file_get_contents($file) ?? null;

  $map = $data ? json_decode($data, true) : null;
  $map = $map[array_key_first($map)] ?? null;

  $chars = [];

  if ($map) {
    // Find the start and the end of the path in the JSON file
    for ($i = 0; $i < count($map); $i++) {
      for ($j = 0; $j < count($map[$i]); $j++) {
        $val = strtolower($map[$i][$j]);
        $chars[] = $val;
        switch ($val) {
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
  }
  if (array_search("s", $chars) && array_search("e", $chars)) {
    // Fill the matrix with the JSON file content
    return $matrix->setMap($map);
  }
  return null;
}
