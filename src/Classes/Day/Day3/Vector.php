<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day\Day3;

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
        $this->setX($x);
        $this->setY($y);
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

    public function setPositionFromSpot(Vector $spot): void
    {
        $this->setX($spot->getX());
        $this->setY($spot->getY());
    }

    public function moveInDirection(int $direction): void
    {
        switch ($direction) {
            case Matrix::DIRECTION_RIGHT:
                $this->x++;
                break;
            case Matrix::DIRECTION_UP:
                $this->y--;
                break;
            case Matrix::DIRECTION_LEFT:
                $this->x--;
                break;
            case Matrix::DIRECTION_DOWN:
                $this->y++;
                break;
            default:
                break;
        }
    }
}
