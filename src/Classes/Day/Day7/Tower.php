<?php

namespace Sventendo\AdventOfCode2017\Day\Day7;

class Tower
{
    /**
     * @var Program[]
     */
    private $programs;

    /**
     * @var Program
     */
    private $highestUnstableProgram;

    public function initializeFromRows(array $rows): void
    {
        foreach ($rows as $row) {
            $this->addProgramFromRow($row);
        }

        $this->addRelations();
    }

    public function getBottomProgram(): Program
    {
        $bottomProgram = null;
        foreach ($this->programs as $program) {
            if ($program->getParent() === null) {
                $bottomProgram = $program;
                break;
            }
        }

        return $bottomProgram;
    }

    public function findUnbalancedPrograms(Program $program = null): void
    {
        if ($program === null) {
            $program = $this->getBottomProgram();
        }

        $weightGroups = [];
        foreach ($program->getChildren() as $child) {
            $totalWeight = $child->getTotalWeight();
            if (array_key_exists($totalWeight, $weightGroups) === false) {
                $weightGroups[$totalWeight] = [];
            }
            $weightGroups[$totalWeight][] = $child->getName();
        }

        if (\count($weightGroups) > 1) {
            $this->setHighestUnstableProgram($program);
            foreach ($program->getChildren() as $child) {
                $this->findUnbalancedPrograms($child);
            }
        }
    }

    public function getHighestUnstableProgram(): Program
    {
        return $this->highestUnstableProgram;
    }

    public function getFirstSiblingWeight(Program $program): int
    {
        $siblings = $this->getSiblings($program);

        return $siblings->getFirst()->getWeight();
    }

    public function getCorrectedWeightForProgramWithOffWeight(): int
    {
        $layer = new Layer($this->getHighestUnstableProgram()->getChildren());
        $layer->findReferenceWeight();

        return $layer->getCorrectedWeightForOffWeightProgram();
    }

    private function addProgramFromRow(string $row): void
    {
        preg_match('/(\w*)\s\((\w*)\)(\s->\s)?(.*)/', $row, $matches);

        if (\count($matches) >= 2) {
            $name = $matches[1];
            $this->programs[$name] = $this->createProgram($matches);
        }
    }

    private function createProgram(array $matches): Program
    {
        $program = new Program();
        $program->setName($matches[1]);
        $program->setWeight((int)$matches[2]);
        $program->setChildrenNames($this->trimExplode($matches[4]));

        return $program;
    }

    private function addRelations(): void
    {
        foreach ($this->programs as $program) {
            foreach ($program->getChildrenNames() as $childName) {
                $childProgram = $this->getProgramByName($childName);
                $childProgram->setParent($program);
                $program->addChild($childProgram);
            }
        }
    }

    private function getProgramByName(string $name): Program
    {
        try {
            $program = $this->programs[$name];
        } catch (\Exception $e) {
            throw new \Exception('Program with name ' . $name . ' not found.');
        }

        return $program;
    }

    private function trimExplode($string): array
    {
        $values = [];
        if (trim($string) !== '') {
            $values = explode(',', $string);
            foreach ($values as &$name) {
                $name = trim($name);
            }
        }

        return $values;
    }

    private function setHighestUnstableProgram(Program $program): void
    {
        $this->highestUnstableProgram = $program;
    }

    private function getSiblings(Program $program): Layer
    {
        $layer = new Layer();
        if ($program->getParent() !== null) {
            $childrenOfParent = $program->getParent()->getChildren();
            foreach ($childrenOfParent as $child) {
                if ($child->getName() !== $program->getName()) {
                    $layer->addProgram($child);
                }
            }
        }

        return $layer;
    }
}
