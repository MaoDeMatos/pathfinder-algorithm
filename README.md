# Pathfinder algorithm

[Initial approach](./information/initial.md)

## Goal

Make a pathfinder algorithm capable of using a 2D array as a map to find the shortest path between two points.

It must :

- Travel **only up/down** and **left/right**, *no diagonals allowed*
- Travel through ***1***s and avoid ***0***s
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

If you want to generate a random map :

```sh
# Simply don't use any arguments
php functional.php
```

If you want to use a JSON file :

```sh
# In the root dir
php functional.php {JSON file path}
```

```sh
# Example
php functional.php ./data/example.json
```

## JSON File format

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

```sh
IF THERE ARE MULTIPLE GRIDS IN THE FILE, IT WILL ONLY TAKE THE FIRST ELEMENT

YOU MUST HAVE A "S" (START) AND A "E" (END) IN THE ARRAY OR IT WILL DISPLAY AN "INVALID FILE FORMAT" ERROR

IF THERE ARE MULTIPLE STARTS OR ENDS, ONLY THE LAST ONE OF EACH WILL BE USED

IT WILL ONLY STOP ON 0s, NON RECOGNIZED CHARS/NUMBERS WILL BE TURNED INTO 1s
```
