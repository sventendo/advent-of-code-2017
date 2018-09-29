<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day11\Board;

class Day11 implements Day
{
    public function firstPuzzle(string $input): int
    {
        $directions = $this->parseDirections($input);
        $board = new Board();
        $board->followDirections($directions);

        return $board->getStepsFromOrigin();
    }

    public function secondPuzzle(string $input): int
    {
        $directions = $this->parseDirections($input);
        $board = new Board();
        $board->setMonitorMaxDistance(true);
        $board->followDirections($directions);

        return $board->getMaxDistance();
    }

    private function parseDirections($input): array
    {
        return $this->trimExplode(',', $input);
    }

    private function trimExplode(string $delimiter, string $string): array
    {
        $values = [];

        $stringBits = explode($delimiter, $string);
        foreach($stringBits as $stringBit) {
            if (trim($stringBit) !== '') {
                $values[] = trim($stringBit);
            }
        }

        return $values;
    }
}
