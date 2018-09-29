<?php

namespace Sventendo\AdventOfCode2017\Day\Day13;

class Layer
{
    /**
     * @var int
     */
    private $depth;

    /**
     * @var int
     */
    private $range;

    public function __construct(int $depth = 0, int $range = 0)
    {
        $this->depth = $depth;
        $this->range = $range;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }

    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function setRange(int $range): void
    {
        $this->range = $range;
    }

    public function getPositionAtBeginningOfPicoSecond(int $picoSecond, int $delay = 0): int
    {
        $cycleLength = 2 * ($this->range - 1);
        $positionInCycle = ($picoSecond + $delay) % $cycleLength;

        if ($positionInCycle < $this->range - 1) {
            $position = $positionInCycle;
        } else {
            $position = $cycleLength - $positionInCycle;
        }

        return $position;
    }

}
