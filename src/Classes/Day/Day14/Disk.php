<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day\Day14;

use Sventendo\AdventOfCode2017\Day\Day10\ValueList;

class Disk
{
    public const VALUE_RIGHT = 0;
    public const VALUE_DOWN = 1;
    public const VALUE_LEFT = 2;
    public const VALUE_UP = 3;

    /**
     * @var Row[]
     */
    private $rows = [];

    /**
     * @var string
     */
    private $salt;

    /**
     * @var array
     */
    private $groups = [];

    /**
     * @var int
     */
    private $rowCount = 128;

    /**
     * @var int
     */
    private $rowLength = 128;

    private $debug = false;

    public function __construct($salt = '')
    {
        $this->salt = $salt;
    }

    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    public function generateRows(): void
    {
        foreach (range(1, $this->rowCount) as $i) {
            $this->rows[] = $this->generateRow($i - 1);
        }
    }

    public function convertToBinary(string $checksumChar): string
    {
        return base_convert($checksumChar, 16, 2);
    }

    public function countUsedSquares(): int
    {
        $usedSquares = 0;
        foreach ($this->rows as $row) {
            $usedSquares += $row->getSquaresWithValue(1);
        }

        return $usedSquares;
    }

    public function parseGroups(): void
    {
        while ($firstValueWithNoGroup = $this->getFirstSquareWithNoGroup()) {
            $this->addNewGroup();
            $this->injectValue($firstValueWithNoGroup);
            $this->infectAdjacentValues($firstValueWithNoGroup);
        }
    }

    public function getFirstSquareWithNoGroup(): ?Vector
    {
        $vector = null;

        foreach ($this->rows as $row) {
            if ($vector = $row->getFirstSquareWithGroup('')) {
                break;
            }
        }

        return $vector;
    }

    public function countGroups(): int
    {
        return \count($this->groups);
    }

    public function getRow($index): Row
    {
        foreach ($this->rows as $row) {
            if ($row->getIndex() === $index) {
                return $row;
            }
        }

        throw new \Exception('Invalid row index: ' . $index);
    }

    public function getSnapshot(): string
    {
        $output = 'Values: ' . PHP_EOL;
        $output .= implode(PHP_EOL, array_map(function (Row $row) {
            return $row->getValueString();
        }, $this->getRows()));

        $output .= PHP_EOL;
        $output .= 'Values: ' . PHP_EOL;

        $groupsArray = array_map(function (Row $row) {
            return $row->getGroups();
        }, $this->getRows());

        $output .= implode(PHP_EOL, array_map(function (array $groups) {
            return implode('|', $groups);
        }, $groupsArray));

        return $output;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows($rows): void
    {
        $this->rows = $rows;
        $this->setBounds();
    }

    public function hasAdjacentSquare(Vector $square, int $direction): bool
    {
        $hasAdjacentValue = false;
        switch ($direction) {
            case self::VALUE_RIGHT:
                $hasAdjacentValue = $square->getX() + 1 <= $this->rowLength - 1;
                break;
            case self::VALUE_DOWN:
                $hasAdjacentValue = $square->getY() + 1 <= $this->rowCount - 1;
                break;
            case self::VALUE_LEFT:
                $hasAdjacentValue = $square->getX() - 1 >= 0;
                break;
            case self::VALUE_UP:
                $hasAdjacentValue = $square->getY() - 1 >= 0;
                break;
            default:
                break;
        }

        return $hasAdjacentValue;
    }

    public function squareHasGroup(Vector $vector): bool
    {
        return $this->getRow($vector->getY())->getGroupForSquare($vector->getX()) !== '';
    }

    public function setBounds(): void
    {
        $this->rowCount = \count($this->getRows());
        $this->rowLength = \count($this->getRow(0)->getSquares());
    }

    private function generateRow(int $i): Row
    {
        $knotHash = $this->getKnotHash($i);
        $row = new Row($i);
        $valueString = $this->generateValueFromHash($knotHash);
        $row->setValuesFromString($valueString);

        return $row;
    }

    private function getKnotHash(int $i): string
    {
        return $this->salt . '-' . $i;
    }

    private function generateValueFromHash(string $knotHash): string
    {
        $value = '';

        $checksum = $this->getChecksum($knotHash);
        $checksumChars = str_split($checksum);
        foreach ($checksumChars as $checksumChar) {
            $charBinary = $this->convertToBinary($checksumChar);
            $value .= str_pad($charBinary, 4, '0', STR_PAD_LEFT);
        }

        return $value;
    }

    /**
     * @param string $knotHash
     * @return string
     */
    private function getChecksum(string $knotHash): string
    {
        $valueList = new ValueList();
        $valueList->setSequenceFromString($knotHash, [17, 31, 73, 47, 23]);

        return $valueList->getDenseHashChecksum();
    }

    private function addNewGroup(): void
    {
        $this->groups[] = $this->getGroupIdentifier($this->countGroups() + 1);
    }

    private function getGroupIdentifier(int $index): string
    {
        return 'g_' . $index;
    }

    private function injectValue($value): void
    {
        $this->setGroupForValue($value, $this->getCurrentGroupIdentifier());
        if ($this->debug) {
            echo $this->getSnapshot();
        }
        $this->infectAdjacentValues($value);
    }

    private function setGroupForValue(Vector $value, string $groupIdentifier): void
    {
        $this->getRow($value->getY())->setGroupForSquare($value->getX(), $groupIdentifier);
    }

    private function getCurrentGroupIdentifier(): string
    {
        return $this->getGroupIdentifier($this->countGroups());
    }

    private function infectAdjacentValues(Vector $value): void
    {
        foreach ($this->getDirections() as $direction) {
            if ($this->hasAdjacentSquare($value, $direction)) {
                $adjacentValue = $this->getAdjacentValue($value, $direction);
                if ($this->isInfectable($adjacentValue)) {
                    $this->injectValue($adjacentValue);
                }
            }
        }
    }

    private function getDirections(): array
    {
        return [
            self::VALUE_RIGHT,
            self::VALUE_DOWN,
            self::VALUE_LEFT,
            self::VALUE_UP,
        ];
    }

    private function getAdjacentValue(Vector $value, int $direction): Vector
    {
        $adjacentValue = null;
        switch ($direction) {
            case self::VALUE_RIGHT:
                $adjacentValue = new Vector($value->getX() + 1, $value->getY());
                break;
            case self::VALUE_DOWN:
                $adjacentValue = new Vector($value->getX(), $value->getY() + 1);
                break;
            case self::VALUE_LEFT:
                $adjacentValue = new Vector($value->getX() - 1, $value->getY());
                break;
            case self::VALUE_UP:
                $adjacentValue = new Vector($value->getX(), $value->getY() - 1);
                break;
            default:
                break;
        }

        return $adjacentValue;
    }

    private function isInfectable(Vector $square): bool
    {
        return $this->getSquareValue($square) === 1 && $this->squareHasGroup($square) === false;
    }

    private function getSquareValue(Vector $square): int
    {
        return $this->getRow($square->getY())->getValue($square->getX());
    }
}
