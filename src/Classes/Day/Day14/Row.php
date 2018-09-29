<?php

namespace Sventendo\AdventOfCode2017\Day\Day14;

class Row
{
    /**
     * @var Square[]
     */
    private $squares = [];

    /**
     * @var int
     */
    private $index = 0;

    public function __construct(int $index, string $values = '')
    {
        $this->setIndex($index);
        if (trim($values) !== '') {
            $this->setValuesFromString($values);
        }
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function setIndex($i): void
    {
        $this->index = $i;
    }

    /**
     * @return Square[]
     */
    public function getSquares(): array
    {
        return $this->squares;
    }

    public function setSquares(array $squares): void
    {
        $this->squares = $squares;
    }

    public function setValuesFromString($valueString): void
    {
        $squares = [];
        foreach (str_split($valueString) as $value) {
            $squares[] = new Square((int)$value);
        }

        $this->setSquares($squares);
    }

    public function getSquaresWithValue(int $value): int
    {
        return \count(array_filter($this->getSquares(), function (Square $square) use ($value) {
            return $square->getValue() === $value;
        }));
    }

    public function getFirstSquareWithGroup(string $group): ?Vector
    {
        $vector = null;
        foreach ($this->getSquares() as $index => $square) {
            if ($square->getValue() === 1 && $square->getGroup() === $group) {
                $vector = new Vector($index, $this->index);
                break;
            }
        }

        return $vector;
    }

    public function getGroupForSquare($index): string
    {
        return $this->getSquare($index)->getGroup();
    }

    private function getSquare(int $index): Square
    {
        return $this->squares[$index];
    }

    public function setGroupForSquare($index, $groupIdentifier): void
    {
        $this->getSquare($index)->setGroup($groupIdentifier);
    }

    public function getValueString(): string
    {
        return implode('', array_map(function (Square $square) {
            return $square->getValue();
        }, $this->getSquares()));
    }

    public function getGroups(): array
    {
        return array_map(function (Square $square) {
            return $square->getGroup();
        }, $this->getSquares());
    }

    public function getValue(int $index): int
    {
        return $this->getSquare($index)->getValue();
    }
}
