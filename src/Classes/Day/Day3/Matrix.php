<?php

namespace Sventendo\AdventOfCode2017\Day\Day3;

class Matrix
{
    public const DIRECTION_RIGHT = 0;
    public const DIRECTION_UP = 1;
    public const DIRECTION_LEFT = 2;
    public const DIRECTION_DOWN = 3;

    private $values = [
        [1],
    ];

    /**
     * @var Vector
     */
    private $position;

    /**
     * @var int
     */
    private $highestValue = 1;

    public function __construct()
    {
        $this->position = new Vector(0, 0);
    }

    public function isFree(Vector $spot): bool
    {
        return empty($this->values[$spot->getX()][$spot->getY()]);
    }

    public function setPosition(Vector $spot): void
    {
        $this->position->setPositionFromSpot($spot);
    }

    public function getSpotValue(Vector $spot): int
    {
        $value = 0;
        if (!empty($this->values[$spot->getX()][$spot->getY()])) {
            $value = (int)$this->values[$spot->getX()][$spot->getY()];
        }

        return $value;
    }

    public function setSpotValue(Vector $spot): void
    {
        $value = $this->calculateSpotValue($spot);
        $this->values[$spot->getX()][$spot->getY()] = $value;
        $this->setHighestValue($value);
    }

    public function calculateSpotValue(Vector $spot): int
    {
        $sum = 0;

        $adjacentRelativeSpots = [
            new Vector(1, 0),
            new Vector(1, -1),
            new Vector(0, -1),
            new Vector(-1, -1),
            new Vector(-1, 0),
            new Vector(-1, 1),
            new Vector(0, 1),
            new Vector(1, 1),
        ];

        foreach ($adjacentRelativeSpots as $adjacentRelativeSpot) {
            $adjacentSpot = $this->getRelativeSpot($spot, $adjacentRelativeSpot);
            $sum += $this->getSpotValue($adjacentSpot);
        }

        return $sum;
    }

    private function getRelativeSpot(Vector $spot, Vector $relativeSpot): Vector
    {
        return new Vector($spot->getX() + $relativeSpot->getX(), $spot->getY() + $relativeSpot->getY());
    }

    public function getHighestValue(): int
    {
        return $this->highestValue;
    }

    private function setHighestValue(int $value): void
    {
        $this->highestValue = $value;
    }

    public function getPosition(): Vector
    {
        return $this->position;
    }

}
