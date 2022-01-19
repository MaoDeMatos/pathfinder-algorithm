<?php

require_once 'autoload.php';

// $matrix = new Matrix(4, 4);
$matrix = new Matrix();
$matrix->setSize(12, 12);

$gen = new MatrixGenerator();
$matrix = $gen->fill($matrix);

$matrix->display();

$test = ["x" => 1, "y" => 2];
