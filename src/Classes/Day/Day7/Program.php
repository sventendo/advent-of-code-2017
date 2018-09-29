<?php

namespace Sventendo\AdventOfCode2017\Day\Day7;

class Program
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $weight = 0;

    /**
     * @var Program
     */
    private $parent;

    /**
     * @var Program[]
     */
    private $children = [];

    /**
     * @var array
     */
    private $childrenNames = [];

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return Program
     */
    public function getParent(): ?Program
    {
        return $this->parent;
    }

    /**
     * @param Program $parent
     */
    public function setParent(Program $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return array
     */
    public function getChildrenNames(): array
    {
        return $this->childrenNames;
    }

    /**
     * @param array $childrenNames
     */
    public function setChildrenNames(array $childrenNames): void
    {
        $this->childrenNames = $childrenNames;
    }

    /**
     * @return Program[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function getTotalWeight(): int
    {
        return $this->weight + $this->getChildrenWeight();
    }

    private function getChildrenWeight(): int
    {
        $weight = 0;
        foreach ($this->getChildren() as $child) {
            $weight += $child->getTotalWeight();
        }

        return $weight;
    }

    public function addChild(Program $program): void
    {
        $this->children[] = $program;
    }

    public function getTotalWeightOfChildren(): int
    {
        return $this->getTotalWeight() - $this->getWeight();
    }

}
