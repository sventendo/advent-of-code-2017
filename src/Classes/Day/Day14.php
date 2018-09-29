<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day14\Disk;

class Day14 implements Day
{
    /**
     * @var Disk
     */
    private $disk;

    public function firstPuzzle(string $input): int
    {
        $this->disk = new Disk($input);
        $this->disk->generateRows();

        return $this->disk->countUsedSquares();
    }

    public function secondPuzzle(string $input): int
    {
        $this->disk = new Disk($input);
        $this->disk->generateRows();
        $this->disk->parseGroups();

        return $this->disk->countGroups();
    }
}
