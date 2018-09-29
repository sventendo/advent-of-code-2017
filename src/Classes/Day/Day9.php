<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day9\Parser;

class Day9 implements Day
{
    /**
     * @var Parser
     */
    private $parser;

    public function firstPuzzle(string $input): int
    {
        $this->initializeParser($input);
        $this->parser->removeIgnoredCharacters();
        $this->parser->removeGarbage();
        $this->parser->calculateGroupsValue();

        return $this->parser->getGroupsValue();
    }

    public function secondPuzzle(string $input): int
    {
        $this->initializeParser($input);
        $this->parser->removeIgnoredCharacters();
        $this->parser->removeGarbage();

        return $this->parser->getGarbageCount();
    }

    private function initializeParser($input): void
    {
        $this->parser = new Parser();
        $this->parser->setString($input);
    }
}
