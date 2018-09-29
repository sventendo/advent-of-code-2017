<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day\Day11;

class Vector
{
    /**
     * @var int
     */
    private $x = 0;

    /**
     * @var int
     */
    private $y = 0;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->setPosition($x, $y);
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): void
    {
        $this->x = $x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): void
    {
        $this->y = $y;
    }

    public function setPosition(int $x, int $y): void
    {
        $this->setX($x);
        $this->setY($y);
    }

    public function setPositionFromVector(Vector $spot): void
    {
        $this->setX($spot->getX());
        $this->setY($spot->getY());
    }

    public function moveInDirection(string $direction): void
    {
        switch ($direction) {
            case Board::DIRECTION_NORTH:
                $this->y += 2;
                break;
            case Board::DIRECTION_NORTH_EAST:
                $this->x++;
                $this->y++;
                break;
            case Board::DIRECTION_SOUTH_EAST:
                $this->x++;
                $this->y--;
                break;
            case Board::DIRECTION_SOUTH:
                $this->y -= 2;
                break;
            case Board::DIRECTION_SOUTH_WEST:
                $this->x--;
                $this->y--;
                break;
            case Board::DIRECTION_NORTH_WEST:
                $this->x--;
                $this->y++;
                break;
            default:
                break;
        }
    }

    public function moveOneStepTowardsOrigin(): void
    {
        if ($this->x === 0) {
            if ($this->y >= 2) {
                $this->moveInDirection(Board::DIRECTION_SOUTH);
            } elseif ($this->y <= -2) {
                $this->moveInDirection(Board::DIRECTION_NORTH);
            }
        } elseif ($this->x > 0) {
            if ($this->y >= 0) {
                $this->moveInDirection(Board::DIRECTION_SOUTH_WEST);
            } elseif ($this->y < 0) {
                $this->moveInDirection(Board::DIRECTION_NORTH_WEST);
            }
        } elseif ($this->x < 0) {
            if ($this->y >= 0) {
                $this->moveInDirection(Board::DIRECTION_SOUTH_EAST);
            } elseif ($this->y < 0) {
                $this->moveInDirection(Board::DIRECTION_NORTH_EAST);
            }
        }
    }

    public function isOrigin(): bool
    {
        return $this->getX() === 0 && $this->getY() === 0;
    }

    public function getPosition(): array
    {
        return [$this->x, $this->y];
    }
}
