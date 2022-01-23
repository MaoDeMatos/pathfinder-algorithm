<?php

use IDisplay;

/**
 * Echo the map
 *
 * @return void
 */
class Display implements IDisplay {
  public function displayMap(Matrix $matrix): void {
    $map = $matrix->getMap();

    // Create the separator and add it to the start of the grid
    $space = '  ';
    $hr = substr($space, -1);

    $longestRow = 0;
    foreach ($map as $row) {
      $longestRow = $longestRow < count($row) ? count($row) : $longestRow;
    }
    for ($i = 0; $i < $longestRow; $i++) {
      $hr = $hr . '---';
    }
    $grid = $hr . PHP_EOL;

    for ($i = 0; $i < count($map); $i++) {
      for ($j = 0; $j < count($map[$i]); $j++) {
        // Color of the start position
        if ([$i, $j] == $matrix->getInitialPos()) {
          $grid = $grid . CONSOLE_BLUE . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
          // Color of the shortest path
        } elseif ($this->searchForPositions($matrix->getShortestPath(), [$i, $j])) {
          $grid = $grid . CONSOLE_GREEN . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
          // Color of the final position
        } elseif ([$i, $j] == $matrix->getFinalPos()) {
          $grid = $grid . CONSOLE_YELLOW . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
          // Color of the blocked positiosns
        } elseif ($map[$i][$j] == 0) {
          $grid = $grid . CONSOLE_GREY . $space . $map[$i][$j] . CONSOLE_DEFAULT_COLOR;
          // Spaces
        } elseif ($map[$i][$j] == "") {
          $grid = $grid . $space . ' ';
        } else $grid = $grid . $space . substr($map[$i][$j], 0, 1);
        // substr used to prevent a cell with multiple chars to break the display
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
