<?php

use IPathfinder;

class PathFinder implements IPathfinder {
  protected Matrix $_matrix;

  protected array $_currentPos = [1, 1];
  protected array $_nextPos = [1, 1];
  protected array $_endPos = [1, 1];

  protected int $steps = 0;

  public function findShortestPath(Matrix $matrix, $startPos, $endPos) {
    if ($startPos == $endPos) {
      return PHP_EOL . "\033[92mFINISHED" . PHP_EOL . "\033[39mSteps count : " . $this->steps++;
    }
  }

  public function compare() {
  }
}
