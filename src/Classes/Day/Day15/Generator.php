<?php

namespace Sventendo\AdventOfCode2017\Day\Day15;

class Generator
{
    /**
     * @var int
     */
    private $value = 0;

    /**
     * @var int
     */
    private $factor = 0;

    /**
     * @var int
     */
    private $divider;

    /**
     * @var int
     */
    private $filterDivider = 1;

    /**
     * @var int[]
     */
    private $valueMemory = [];

    public function __construct(int $divider = 2147483647)
    {
        $this->divider = $divider;
    }

    public function setFactor(int $factor): void
    {
        $this->factor = $factor;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function runCycle(): void
    {
        $this->value = ($this->value * $this->factor) % $this->divider;
    }

    public function getHash($value = null): string
    {
        $value = $value ?: $this->value;

        return substr(str_pad(decbin($value), 16, '0', STR_PAD_LEFT), -16, 16);
    }

    public function isValueValid(): bool
    {
        return $this->value % $this->filterDivider === 0;
    }

    public function setFilterDivider(int $filterDivider): void
    {
        $this->filterDivider = $filterDivider;
    }

    public function storeValidValue(): void
    {
        if ($this->isValueValid()) {
            $this->valueMemory[] = $this->value;
        }
    }

    public function getValueMemory(): array
    {
        return $this->valueMemory;
    }

    public function getValueMemorySize(): int
    {
        return \count($this->valueMemory);
    }

    public function getValueMemoryItem($i): int
    {
        return $this->valueMemory[$i];
    }
}
