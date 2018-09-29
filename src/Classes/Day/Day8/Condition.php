<?php

namespace Sventendo\AdventOfCode2017\Day\Day8;

class Condition
{

    /**
     * @var string
     */
    private $targetName = '';

    /**
     * @var
     */
    private $operator;

    /**
     * @var int
     */
    private $value = 0;

    public function getTargetName(): string
    {
        return $this->targetName;
    }

    public function setTargetName(string $targetName): void
    {
        $this->targetName = $targetName;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setOperator($operator): void
    {
        $this->operator = $operator;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

}
