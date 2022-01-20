<?php

class Matrix {
  /**
   * Two dimensional array
   *
   * @var array
   */
  protected array $_map = [];
  // protected array $_nodeValues = [0, 1, 1];
  protected array $_size = [1, 1];

  protected array $_initialPos = [1, 1];
  protected array $_finalPos = [1, 1];

  public function getSize() {
    return $this->_size;
  }

  /**
   * @param integer $x X axis (rows)
   * @param integer $y Y axis (columns)
   * @return self
   */
  public function setSize(int $x, int $y): self {
    $this->_size = [$x, $y];

    return $this;
  }

  public function getMap() {
    return $this->_map;
  }

  public function setMap(array $map): self {
    $this->_map = $map;

    return $this;
  }

  public function getFinalPos() {
    return $this->_finalPos;
  }

  public function setFinalPos(array $finalPos): self {
    $this->_finalPos = $finalPos;
    return $this;
  }

  public function getInitialPos() {
    return $this->_initialPos;
  }

  public function setInitialPos(array $initialPos): self {
    $this->_initialPos = $initialPos;
    return $this;
  }

  /**
   * Echo the map
   *
   * @return void
   */
  public function display() {
    $map = $this->getMap();

    for ($i = 0; $i < count($map); $i++) {
      for ($j = 0; $j < count($map[$i]); $j++) {
        if ([$i, $j] == $this->_initialPos) {
          echo "\033[31m " . $map[$i][$j] . "\033[39m";
        } elseif ([$i, $j] == $this->_finalPos) {
          echo "\033[33m " . $map[$i][$j] . "\033[39m";
        } elseif ($map[$i][$j] == 0) {
          echo "\033[90m " . $map[$i][$j] . "\033[39m";
        } else echo " " . $map[$i][$j];
      }
      echo PHP_EOL;
    }
  }
}
