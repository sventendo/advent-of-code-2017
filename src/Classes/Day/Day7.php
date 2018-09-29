<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day7\Tower;

class Day7 implements Day
{

    /**
     * @var Tower
     */
    private $tower;

    public function firstPuzzle(string $input): string
    {
        $rows = explode(PHP_EOL, $input);
        $this->initializePrograms($rows);

        return $this->tower->getBottomProgram()->getName();
    }

    public function secondPuzzle(string $input): int
    {
        $rows = explode(PHP_EOL, $input);
        $this->initializePrograms($rows);

        return $this->getCorrectWeightOfHighestUnstableProgram();
    }

    private function initializePrograms(array $rows): void
    {
        $this->tower = new Tower();
        $this->tower->initializeFromRows($rows);
    }

    public function getCorrectWeightOfHighestUnstableProgram(): int
    {
        $this->tower->findUnbalancedPrograms();

        return $this->tower->getCorrectedWeightForProgramWithOffWeight();
    }
}
