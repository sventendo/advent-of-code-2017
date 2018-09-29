<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day8\RegisterArray;

class Day8 implements Day
{
    /**
     * @var string[]
     */
    private $commandStrings = [];

    /**
     * @var RegisterArray
     */
    private $registerArray;

    public function firstPuzzle(string $input): string
    {
        $this->processCommands($input);

        return (string)$this->registerArray->getHighestRegisterValue();
    }

    public function secondPuzzle(string $input): string
    {
        $this->processCommands($input);

        return (string)$this->registerArray->getHighestValue();
    }

    /**
     * @param string $input
     */
    private function processCommands(string $input): void
    {
        $this->commandStrings = explode(PHP_EOL, $input);
        $this->registerArray = new RegisterArray();

        foreach ($this->commandStrings as $commandString) {
            if (trim($commandString) !== '') {
                $this->registerArray->processCommand($commandString);
            }
        }
    }
}
