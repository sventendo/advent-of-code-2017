<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day12\Plumbing;

class Day12 implements Day
{

    public function firstPuzzle(string $input): int
    {
        $plumbing = new Plumbing();
        $plumbing->setPrograms($this->parseInput($input));

        return $plumbing->getProgramsInGroup(0);
    }

    public function secondPuzzle(string $input): int
    {
        $plumbing = new Plumbing();
        $plumbing->setPrograms($this->parseInput($input));

        return $plumbing->countGroups();
    }

    private function parseInput(string $input): array
    {
        $rows = explode(PHP_EOL, $input);
        $tubes = [];
        foreach ($rows as $row) {
            if (trim($row) !== '') {
                $bits = explode('<->', $row);
                $id = (int)$bits[0];
                $tubes[$id] = [];
                $connectedTubes = explode(',', $bits[1]);
                foreach ($connectedTubes as $connectedTube) {
                    $tubes[$id][] = (int)$connectedTube;
                }
            }
        }

        return $tubes;
    }
}
