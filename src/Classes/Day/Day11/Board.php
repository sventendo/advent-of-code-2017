<?php

namespace Sventendo\AdventOfCode2017\Day\Day11;

class Board
{
    public const DIRECTION_NORTH = 'n';
    public const DIRECTION_NORTH_EAST = 'ne';
    public const DIRECTION_SOUTH_EAST = 'se';
    public const DIRECTION_SOUTH = 's';
    public const DIRECTION_SOUTH_WEST = 'sw';
    public const DIRECTION_NORTH_WEST = 'nw';

    /**
     * @var Vector
     */
    private $position;

    /**
     * @var bool
     */
    private $monitorMaxDistance = false;

    /**
     * @var int
     */
    private $maxDistance = 0;

    public function __construct()
    {
        $this->position = new Vector(0, 0);
    }

    public function getPosition(): Vector
    {
        return $this->position;
    }

    public function setPosition(Vector $position): void
    {
        $this->position = $position;
    }

    public function followDirections(array $directions): void
    {
        foreach ($directions as $direction) {
            $this->position->moveInDirection($direction);
            if ($this->monitorMaxDistance === true) {
                $this->maxDistance = max($this->maxDistance, $this->getStepsFromOrigin());
            }
        }
    }

    public function getStepsFromOrigin(): int
    {
        $currentPosition = new Vector();
        $currentPosition->setPositionFromVector($this->position);

        $steps = 0;

        while ($currentPosition->isOrigin() === false) {
            $currentPosition->moveOneStepTowardsOrigin();
            $steps++;
        }

        return $steps;
    }

    public function setMonitorMaxDistance(bool $monitor): void
    {
        $this->monitorMaxDistance = $monitor;
    }

    public function getMaxDistance(): int
    {
        return $this->maxDistance;
    }
}
