<?php

class MatrixGenerator {
  /**
   * Generate matrix values
   *
   * @param Matrix $matrix
   * @return Matrix
   */
  public function generate(Matrix $matrix): Matrix {
    $size = $matrix->getSize();

    for ($i = 0; $i < $size['y']; $i++) {
      $map[$i] = [];

      for ($j = 0; $j < $size['x']; $j++) {
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
    $size = $matrix->getSize();

    for ($i = 0; $i < $size['y']; $i++) {
      $map[$i] = [];

      for ($j = 0; $j < $size['x']; $j++) {
        $map[$i][] = 1;
      }
    }
    return $matrix->setMap($map);
  }
}
