<?php

class MatrixGenerator {
  /**
   * Generate matrix values
   *
   * @param Matrix $matrix
   * @return Matrix
   */
  public function generate(Matrix $matrix): Matrix {
    [$sizeX, $sizeY] = $matrix->getSize();
    $values = $matrix->getNodesValues();

    for ($i = 0; $i < $sizeY; $i++) {
      $map[] = [];

      for ($j = 0; $j < $sizeX; $j++) {
        $map[$i][] = $values[array_rand($values)];
      }
    }
    return $matrix->setMap($map);
  }

  /**
   * Fill matrix with 1s
   *
   * @param Matrix $matrix
   * @return Matrix
   */
  public function fill(Matrix $matrix): Matrix {
    [$sizeX, $sizeY] = $matrix->getSize();

    for ($i = 0; $i < $sizeY; $i++) {
      $map[] = [];

      for ($j = 0; $j < $sizeX; $j++) {
        $map[$i][] = 1;
      }
    }
    return $matrix->setMap($map);
  }

  /**
   * Generate a fully randomized matrix (with random starting and ending points)
   *
   * @param Matrix $matrix
   * @return Matrix
   */
  public function randomMatrix(Matrix $matrix): Matrix {
    $x = 12;
    $y = 10;
    $matrix->setSize($x, $y)
      ->setInitialPos([rand(0, $y - 1), rand(0, $x - 1)])
      ->setFinalPos([rand(0, $y - 1), rand(0, $x - 1)]);

    echo PHP_EOL . "MAP GENERATED RANDOMLY" . PHP_EOL;

    return $this->generate($matrix);
  }
}
