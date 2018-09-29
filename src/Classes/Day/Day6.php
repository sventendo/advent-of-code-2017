<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day6\Bank;

class Day6 implements Day
{
    /**
     * @var Bank
     */
    private $bank;

    public function firstPuzzle(string $input): void
    {
    }

    public function initializeBank(array $values): void
    {
        $this->bank = new Bank($values);
    }

    public function secondPuzzle(string $input): void
    {
    }

    public function runBankCycle(): void
    {
        $this->bank->runCycle();
    }

    public function getCyclesRun(): string
    {
        return $this->bank->countCycles();
    }

    public function getCurrentBankState(): string
    {
        return $this->bank->getCurrentState();
    }

    public function getSequenceLength()
    {
        return $this->bank->getSequenceLength();
    }
}
