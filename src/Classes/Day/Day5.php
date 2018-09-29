<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day5\Maze;

class Day5 implements Day
{

    /**
     * @var Maze
     */
    private $maze;

    public function firstPuzzle(string $input): int
    {
        $values = $this->getValuesFromString($input);
        $this->initializeMaze($values);
        $jumps = 0;
        $length = $this->maze->getLength();

        while ($this->maze->getPosition() < $length) {
            $this->jumpAndAddOne();
            $jumps++;
        }

        return $jumps;
    }

    public function jumpAndAddOne(): void
    {
        $newPosition = $this->maze->getPosition() + $this->maze->getCurrentValue();
        $this->maze->raiseCurrentValue(1);
        $this->maze->setPosition($newPosition);
    }

    private function jumpAndAddOrSubtractOne(): void
    {
        $newPosition = $this->maze->getPosition() + $this->maze->getCurrentValue();
        $modifier = $this->maze->getCurrentValue() >= 3 ? -1 : 1;
        $this->maze->raiseCurrentValue($modifier);
        $this->maze->setPosition($newPosition);
    }

    public function secondPuzzle(string $input): int
    {
        $values = $this->getValuesFromString($input);
        $this->initializeMaze($values);
        $jumps = 0;
        $length = $this->maze->getLength();

        while ($this->maze->getPosition() < $length) {
            $this->jumpAndAddOrSubtractOne();
            $jumps++;
        }

        return $jumps;
    }

    private function getValuesFromString($input): array
    {
        $values = [];
        $rawValues = explode(PHP_EOL, $input);

        foreach ($rawValues as $rawValue) {
            if (trim($rawValue) !== '') {
                $values[] = (int)$rawValue;
            }
        }

        return $values;
    }

    public function initializeMaze(array $values): void
    {
        $this->maze = new Maze($values);
    }

    public function getMazeValues(): array
    {
        return $this->maze->getValues();
    }

}
