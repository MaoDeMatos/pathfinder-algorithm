<?php

class Matrix {
  /**
   * Two dimensional array
   *
   * @var array
   */
  protected array $_map = [];
  // protected array $_nodeValues = [0, 1, 1];
  protected array $_size = ['x' => 1, 'y' => 1];

  protected array $_initialPos = ['x' => 1, 'y' => 1];
  protected array $finalPos = ['x' => 1, 'y' => 1];

  public function getSize() {
    return $this->_size;
  }

  /**
   * @param integer $x X axis (rows)
   * @param integer $y Y axis (columns)
   * @return self
   */
  public function setSize(int $x, int $y): self {
    $this->_size['x'] = $x;
    $this->_size['y'] = $y;

    return $this;
  }

  public function setMap(array $map): self {
    $this->_map = $map;

    return $this;
  }

  public function getMap() {
    return $this->_map;
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
        if (!$map[$i][$j]) {
          echo "\033[31m " . $map[$i][$j] . "\033[0m";
        } else echo " " . $map[$i][$j];
      }
      echo PHP_EOL;
    }
  }
}
