<?php

namespace Sventendo\AdventOfCode2017\Day\Day5;

class Maze
{
    /**
     * @var int[]
     */
    private $values;

    /**
     * @var int
     */
    private $position = 0;

    public function __construct($values)
    {
        $this->values = $values;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function getCurrentValue(): int
    {
        return $this->values[$this->position];
    }

    public function raiseCurrentValue(int $modifier): void
    {
        $this->values[$this->position] += $modifier;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getLength(): int
    {
        return \count($this->values);
    }

    public function getValue($position): int
    {
        return $this->values[$position];
    }
}
