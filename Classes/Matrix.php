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
}
