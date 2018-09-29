<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day3\Matrix;
use Sventendo\AdventOfCode2017\Day\Day3\Vector;

class Day3 implements Day
{
    /**
     * @var Matrix
     */
    private $matrix;

    /**
     * @var int
     */
    private $direction = Matrix::DIRECTION_DOWN;

    public function firstPuzzle(string $input): int
    {
        return $this->getTaxiCabDistance((int)$input);
    }

    public function secondPuzzle(string $input): void
    {
        $this->buildSpiral((int)$input);
    }

    public function getRingForValue($input): int
    {
        $ring = 1;
        while ($input > $this->getMaxValueForRing($ring)) {
            $ring++;
        }

        return $ring;
    }

    public function getMaxValueForRing($ring): int
    {
        return (int)($ring * ($ring + 1) * 0.5 * 8 + 1);
    }

    public function getLengthOfRing($ring): int
    {
        return (int)(2 * $ring + 1);
    }

    public function getDistanceFromEdgeCenter($value): int
    {
        $ring = $this->getRingForValue($value);
        $edgeLength = $this->getLengthOfRing($ring);
        $maxValueOfRing = $this->getMaxValueForRing($ring);

        $abstractEdgeLength = $edgeLength - 1;
        $valueOnAbstractEdge = ($maxValueOfRing - $value) % $abstractEdgeLength;

        return (int)abs($valueOnAbstractEdge - $abstractEdgeLength / 2);
    }

    private function getTaxiCabDistance(int $value): int
    {
        $ring = $this->getRingForValue($value);
        $distanceFromEdgeCenter = $this->getDistanceFromEdgeCenter($value);

        return $ring + $distanceFromEdgeCenter;
    }

    private function getNextDirection(): int
    {
        return ($this->direction + 1) % 4;
    }

    public function buildSpiral(int $thresholdValue): void
    {
        $this->matrix = new Matrix();

        while ($this->matrix->getHighestValue() < $thresholdValue) {
            if ($this->matrix->isFree($this->nextSpotInNewDirection())) {
                $this->matrix->setSpotValue($this->nextSpotInNewDirection());
                $nextSpotInNewDirection = $this->nextSpotInNewDirection();
                $this->matrix->setPosition($nextSpotInNewDirection);
                $this->updateDirection();
            } else {
                $this->matrix->setSpotValue($this->nextSpotInOldDirection());
                $this->matrix->setPosition($this->nextSpotInOldDirection());
            }
        }

        echo $this->matrix->getHighestValue();
    }

    private function nextSpotInNewDirection(): Vector
    {
        return $this->nextSpotInTestDirection($this->getNextDirection());
    }

    private function updateDirection(): void
    {
        $this->direction = $this->getNextDirection();
    }

    private function nextSpotInOldDirection(): Vector
    {
        return $this->nextSpotInTestDirection($this->direction);
    }

    private function nextSpotInTestDirection(int $direction): Vector
    {
        $nextSpot = new Vector();
        $nextSpot->setPositionFromSpot($this->matrix->getPosition());
        $nextSpot->moveInDirection($direction);

        return $nextSpot;
    }
}
