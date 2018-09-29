<?php

namespace Sventendo\AdventOfCode2017\Day\Day14;

class Square
{
    /**
     * @var int
     */
    private $value;

    /**
     * @var string
     */
    private $group = '';

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setGroup(string $group): void
    {
        $this->group = $group;
    }
}
