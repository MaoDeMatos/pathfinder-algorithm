<?php

class Matrix {
  /**
   * Two dimensional array
   *
   * @var array
   */
  protected array $_map;
  protected array $_nodesValues = [0, 1, 1, 1];
  protected array $_size = [4, 4];

  protected array $_initialPos = [1, 1];
  protected array $_finalPos = [1, 1];
  protected array $_shortestPath = [];

  public function getMap() {
    return $this->_map;
  }

  public function setMap(array $map): self {
    $this->_map = $map;

    return $this;
  }

  public function getNodesValues() {
    return $this->_nodesValues;
  }

  public function setNodesValues(array $nodesValues): self {
    $this->_nodesValues = $nodesValues;

    return $this;
  }

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

  public function getInitialPos() {
    return $this->_initialPos;
  }

  public function setInitialPos(array $initialPos): self {
    $this->_initialPos = $initialPos;
    return $this;
  }

  public function getFinalPos() {
    return $this->_finalPos;
  }

  public function setFinalPos(array $finalPos): self {
    $this->_finalPos = $finalPos;
    return $this;
  }

  public function getShortestPath() {
    return $this->_shortestPath;
  }

  public function setShortestPath(array $shortestPath): self {
    $this->_shortestPath = $shortestPath;
    return $this;
  }

  /**
   * Echo the map
   *
   * @return void
   */
  public function display() {
    $map = $this->getMap();

    // Create the separator and add it to the start of the grid
    $space = '  ';
    $hr = substr($space, -1);

    for ($i = 0; $i < count($map[0]); $i++) {
      $hr = $hr . '---';
    }
    $grid = $hr . PHP_EOL;

    // Add the colored values to the grid
    for ($i = 0; $i < count($map); $i++) {
      for ($j = 0; $j < count($map[$i]); $j++) {
        if ([$i, $j] == $this->_initialPos) {
          $grid = $grid . CONSOLE_BLUE . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
        } elseif ($this->searchForPositions($this->_shortestPath, [$i, $j])) {
          $grid = $grid . CONSOLE_GREEN . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
        } elseif ([$i, $j] == $this->_finalPos) {
          $grid = $grid . CONSOLE_YELLOW . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
        } elseif ($map[$i][$j] == 0) {
          $grid = $grid . CONSOLE_GREY . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
        } else $grid = $grid . $space . $map[$i][$j];
      }
      $grid = $grid . PHP_EOL;
    }
    echo $grid . PHP_EOL;
  }

  private function searchForPositions($haystack, $needle): ?int {
    foreach ($haystack as $key => $val) {
      if ($val === $needle) {
        return $key;
      }
    }
    return null;
  }
}
