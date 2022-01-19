<?php

/**
 * Implements the function "findShortestPath"
 */
interface IPathfinder {
  public function findShortestPath(Matrix $matrix, $startPos, $endPos);
}
