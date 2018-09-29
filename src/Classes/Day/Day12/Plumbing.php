<?php

namespace Sventendo\AdventOfCode2017\Day\Day12;

class Plumbing
{
    /**
     * @var array
     */
    private $programs = [];

    /**
     * @var array
     */
    private $programsInGroup = [];

    /**
     * @var int
     */
    private $currentGroup = 0;

    private $programPool = [];

    public function setPrograms(array $programs): void
    {
        $this->programs = $programs;
        $this->programPool = array_keys($programs);
    }

    public function getProgramsInGroup(int $program): int
    {
        $this->fillGroup($program);

        return \count($this->programsInGroup[$program]);
    }

    public function countGroups(): int
    {
        while (\count($this->programPool) > 0) {
            /** @var int[] $arrayWithFirstItem */
            $arrayWithFirstItem = \array_slice($this->programPool, 0, 1);
            $this->fillGroup($arrayWithFirstItem[0]);
        }

        return \count($this->programsInGroup);
    }

    private function getProgram(int $program): array
    {
        return $this->programs[$program];
    }

    private function setProgramsInGroup(int $group, array $programs): void
    {
        $this->programsInGroup[$group] = $programs;
    }

    private function addProgramToGroup(int $program): void
    {
        $this->programsInGroup[$this->currentGroup][] = $program;
    }

    /**
     * @param int $program
     */
    private function addConnectedPrograms(int $program): void
    {
        foreach ($this->getProgram($program) as $connectedProgram) {
            if (\in_array($connectedProgram, $this->getProgramsInCurrentGroup(), true) === false) {
                $this->addProgramToGroup($connectedProgram);
                $this->removeFromPool($connectedProgram);
                $this->addConnectedPrograms($connectedProgram);
            }
        }
    }

    private function setCurrentGroup(int $program): void
    {
        $this->currentGroup = $program;
    }

    private function getProgramsInCurrentGroup(): array
    {
        return $this->programsInGroup[$this->currentGroup];
    }

    private function removeFromPool($program): void
    {
        if (\in_array($program, $this->programPool, true)) {
            unset($this->programPool[array_search($program, $this->programPool, true)]);
        }
    }

    /**
     * @param int $program
     */
    private function fillGroup(int $program): void
    {
        $this->setCurrentGroup($program);
        $this->setProgramsInGroup($program, [$program]);
        $this->removeFromPool($program);
        $this->addConnectedPrograms($program);
    }
}
