<?php

namespace Sventendo\AdventOfCode2017\Day\Day7;

class Layer
{
    /**
     * @var array
     */
    private $programs;

    /**
     * @var Program
     */
    private $programWithOffWeight;

    /**
     * @var int
     */
    private $referenceWeight = 0;

    /**
     * @var array
     */
    private $weightGroups = [];

    public function __construct(array $programs = [])
    {
        $this->programs = $programs;
    }

    public function addProgram(Program $program): void
    {
        $this->programs[] = $program;
    }

    public function getFirst(): Program
    {
        return $this->programs[0];
    }

    public function findReferenceWeight(): int
    {
        foreach ($this->programs as $child) {
            $this->addToWeightGroups($child);
        }

        foreach ($this->weightGroups as $totalWeight => $group) {
            if (\count($group) === 1) {
                $this->programWithOffWeight = $group[0];
            } else {
                $this->referenceWeight = $totalWeight;
            }
        }

        return $this->referenceWeight;
    }

    public function getCorrectedWeightForOffWeightProgram(): int
    {
        $weightOfChildren = $this->programWithOffWeight->getTotalWeightOfChildren();

        return $this->referenceWeight - $weightOfChildren;
    }

    private function addToWeightGroups(Program $program): void
    {
        $totalWeight = $program->getTotalWeight();
        if (array_key_exists($totalWeight, $this->weightGroups) === false) {
            $this->weightGroups[$totalWeight] = [];
        }
        $this->weightGroups[$totalWeight][] = $program;
    }
}
