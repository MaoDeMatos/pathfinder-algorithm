<?php

require_once 'autoload.php';

echo "Start is RED - End is YELLOW - Blocked positions are GREY" . PHP_EOL . PHP_EOL;

$map = json_decode(file_get_contents("./data.json"));

$matrix = new Matrix();
$matrix->setSize(6, 6)
  // ->setMap($map->simple)
  ->setInitialPos([2, 1])
  ->setFinalPos([3, 4]);

$gen = new MatrixGenerator();
$matrix = $gen->fill($matrix);

$matrix->display();

$steps = 0;

print_r(
  findPath(
    $matrix,
    $matrix->getInitialPos(),
    $matrix->getFinalPos()
  )
);

function findPath(
  Matrix $matrix,
  array $initialPos,
  array $finalPos
) {
  global $steps;
  $directions = [
    [-1, 0],
    [1, 0],
    [0, -1],
    [0, 1],
  ];

  $map = $matrix->getMap();

  $queue = is_array(
    $initialPos[array_key_first($initialPos)]
  ) ? $initialPos : [$initialPos];

  // [$nextX, $nextY] = $initialPos;
  [$finalX, $finalY] = $finalPos;

  foreach ($queue as $k => [$currX, $currY]) {
    // print_r($currX);
    // echo " - ";
    // print_r($currY);
    // echo PHP_EOL;

    // If Start or Finish positions are blocked paths
    if ($map[$currX][$currY] == 0 || $map[$finalX][$finalY] == 0) {
      return PHP_EOL . "\033[31mCANNOT STAND OR END ON A BLOCKED PATH\033[39m" . PHP_EOL . PHP_EOL;
    }

    // If at the end
    if ([$currX, $currY] == [$finalX, $finalY]) {
      return PHP_EOL
        . "\033[92mEND\033[39m"
        . PHP_EOL
        . "Steps count : "
        . $steps
        . PHP_EOL;
    } else {
      $map[$currX][$currY] = 9;
      $matrix->setMap($map);
      // Debug
      echo PHP_EOL;
      $matrix->display();
      // exit;

      foreach ($directions as [$dX, $dY]) {
        $nextX = $currX + $dX;
        $nextY = $currY + $dY;

        if (isset($map[$nextX][$nextY]) && $map[$nextX][$nextY] == 1) {
          // echo PHP_EOL . "\033[92m[" . $nextX . ", " . $nextY . "]\033[39m";
          unset($queue[$k]);

          $queue[] = [$nextX, $nextY];
        }
      }
      return findPath($matrix, $queue, $finalPos);
    }
  }
}

// $matrix->display();
