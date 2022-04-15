# Pathfinder algorithm

Studying project.

[Initial approach](./information/initial.md)

## Goal

Make a pathfinder algorithm capable of using a 2D array as a map to find the shortest path between two points.

It must :

- Travel **only up/down** and **left/right**, _no diagonals allowed_
- Travel through **_1_**s and avoid **_0_**s
- Return the distance of the shortest path
- Return the map with the path displayed
- Return an error message if there are no paths, invalid data is provided, etc...

## What it does

- Finds the shortest path from point A (initial position) to point B (final position)
- Use a JSON file as input
- Generates a map if there is no JSON file given
- Displays error messages and the mode used (random map or JSON file)
- Displays the map in the CLI with a coloured array, AFTER the algorithm searches through it

## What I did

I first made a `Matrix` object along with its `MatrixGenerator`, to make random matrixes.

I made JSON files to store predefined grids.

I followed my initial plan (doing the first version entirely myself), but I lacked some ways to get a trace of where the algorithm already checked, so I went online to read a bit about Dijkstra, A Star and DFS/BFS.

I was tempted to go for A Star because my movement system was a bit closer to it, but the conditions and queue system were easier to implement from BFS pseudo-code, so I did the rest by taking inspiration from BFS.

## How to use

❗ Execute commands in the project root dir.

If you want to generate a random map :

```sh
php functional.php
```

If you want to use a JSON file :

```sh
php functional.php {JSON file path}

# Example
php functional.php ./data/example.json
```

## JSON File format

If there are multiple grids in the file, il will only take the first element.

You must have a "s" (start) and a "e" (end) (case insensitive) in the array of it will display an "invalid file format" error.

If there are multiple starts or end, only the last one of each will be used.

It will stop on 0s, empty cells or non recognized chars/numbers.

The JSON files provided must be structured as following :

```json
{
  "example": [
    [1, 1, 1, 1, 1],
    ["e", 1, 0, 0, 1],
    [0, 1, 1, 0, 1],
    [0, 1, 1, 1, "S"],
    [1, 1, 0, 1, 1],
    [1, 1, 1, 1, 0]
  ]
}
```

You can use any 2D array, even with different line sizes and empty lines or cells.

```json
{
  "non_rectangle": [
    [1, 1, 0, 1, 1],
    [],
    [0, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 0, 1, 1],
    [1, "s", 0, "", 0, 1, 1],
    [0, 1, 0, 1, 1, 1],
    [1, 1, 1, 1, "", 1, 1, 0],
    ["", 1, "", 1, "", 1],
    [1, 1, 0, 1, 0, "e", 1],
    ["", "", "", "", "", 1]
  ]
}
```

## Caveats

It seems the algorithm empties the queue even if the final point is found :

In some cases, positions after the end are still checked.
