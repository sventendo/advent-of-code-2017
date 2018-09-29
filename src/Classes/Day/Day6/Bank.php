<?php

namespace Sventendo\AdventOfCode2017\Day\Day6;

class Bank
{
    /**
     * @var int[]
     */
    private $values;

    /**
     * @var int
     */
    private $pointer;

    /**
     * @var array
     */
    private $states = [];

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getHighestPosition(): int
    {
        return array_search(max($this->values), $this->values, true);
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function spreadValueFromPosition(int $position): void
    {
        $value = $this->getValue($position);
        $this->resetValue($position);
        $this->setPointer($position);

        while ($value > 0) {
            $this->movePointer(1);
            $this->addValueAtPointer(1);
            $value--;
        }

    }

    private function getValue(int $position): int
    {
        return $this->values[$position];
    }

    private function resetValue(int $position): void
    {
        $this->values[$position] = 0;
    }

    private function setPointer(int $position): void
    {
        $this->pointer = $position;
    }

    private function addValueAtPointer($value): void
    {
        $this->values[$this->pointer] += $value;
    }

    private function movePointer($value): void
    {
        $this->pointer = ($this->pointer + $value) % \count($this->values);
    }

    public function runCycle(): void
    {
        while ($this->isStateUnique()) {
            $this->addCurrentState();
            $this->spreadHighestValue();
        }
    }

    private function spreadHighestValue(): void
    {
        $this->spreadValueFromPosition($this->getHighestPosition());
    }

    private function addCurrentState(): void
    {
        $this->addState($this->getCurrentState());
    }

    public function getCurrentState(): string
    {
        return implode('|', $this->getValues());
    }

    private function addState(string $state): void
    {
        $this->states[] = $state;
    }

    private function isStateUnique(): bool
    {
        return \in_array($this->getCurrentState(), $this->states, true) === false;
    }

    public function countCycles(): int
    {
        return \count($this->states);
    }

    public function getSequenceLength()
    {
        $firstOccurrenceOfState = array_search($this->getCurrentState(), $this->states, true);

        return \count($this->states) - $firstOccurrenceOfState;
    }
}
