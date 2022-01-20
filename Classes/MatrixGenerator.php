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

    for ($i = 0; $i < $sizeY; $i++) {
      $map[] = [];

      for ($j = 0; $j < $sizeX; $j++) {
        $map[$i][] = rand(0, 1);
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
}
