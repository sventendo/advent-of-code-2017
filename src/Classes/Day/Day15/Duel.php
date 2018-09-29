<?php

namespace Sventendo\AdventOfCode2017\Day\Day15;

class Duel
{
    private $matches = 0;

    /**
     * @var Generator
     */
    private $generatorA;

    /**
     * @var Generator
     */
    private $generatorB;

    /**
     * @var bool
     */
    private $matchFilter = false;

    public function __construct(Generator $generatorA = null, Generator $generatorB = null)
    {
        $this->generatorA = $generatorA;
        $this->generatorB = $generatorB;
    }

    public function getMatches(): int
    {
        return $this->matches;
    }

    public function getGeneratorA(): Generator
    {
        return $this->generatorA;
    }

    public function setGeneratorA(Generator $generatorA): void
    {
        $this->generatorA = $generatorA;
    }

    public function getGeneratorB(): Generator
    {
        return $this->generatorB;
    }

    public function setGeneratorB(Generator $generatorB): void
    {
        $this->generatorB = $generatorB;
    }

    public function runGenerateCycles(int $int): void
    {
        for ($i = 0; $i < $int; $i++) {
            $this->generatorA->runCycle();
            $this->generatorB->runCycle();
            $this->checkMatch();
        }
    }

    public function setMatchFilter(bool $matchFilter): void
    {
        $this->matchFilter = $matchFilter;
    }

    public function countMatches(): void
    {
        for ($i = 0; $i < $this->generatorA->getValueMemorySize(); $i++) {
            $this->checkMatch($this->generatorA->getValueMemoryItem($i), $this->generatorB->getValueMemoryItem($i));
        }
    }

    public function runGenerateCyclesForMatches(int $cycles): void
    {
        foreach ($this->getGenerators() as $generator) {
            while ($generator->getValueMemorySize() < $cycles) {
                $generator->runCycle();
                $generator->storeValidValue();
            }
        }
    }

    private function checkMatch($valueA = null, $valueB = null): void
    {
        if ($this->generatorA->getHash($valueA) === $this->generatorB->getHash($valueB)) {
            $this->matches++;
        }
    }

    /**
     * @return Generator[]
     */
    private function getGenerators(): array
    {
        return [
            $this->generatorA,
            $this->generatorB,
        ];
    }
}
