<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day15\Duel;
use Sventendo\AdventOfCode2017\Day\Day15\Generator;

class Day15 implements Day
{

    public function firstPuzzle(string $input): int
    {

        $generatorA = new Generator();
        $generatorA->setValue(277);
        $generatorA->setFactor(16807);

        $generatorB = new Generator();
        $generatorB->setValue(349);
        $generatorB->setFactor(48271);

        $duel = new Duel($generatorA, $generatorB);
        $duel->runGenerateCycles(40000000);

        return $duel->getMatches();
    }

    public function secondPuzzle(string $input): int
    {
        $generatorA = new Generator();
        $generatorA->setValue(277);
        $generatorA->setFactor(16807);
        $generatorA->setFilterDivider(4);

        $generatorB = new Generator();
        $generatorB->setValue(349);
        $generatorB->setFactor(48271);
        $generatorB->setFilterDivider(8);

        $duel = new Duel($generatorA, $generatorB);
        $duel->setMatchFilter(true);
        $duel->runGenerateCyclesForMatches(5000000);
        $duel->countMatches();

        return $duel->getMatches();
    }
}
