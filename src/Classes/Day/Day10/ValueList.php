<?php

namespace Sventendo\AdventOfCode2017\Day\Day10;

class ValueList
{
    /**
     * @var array
     */
    private $values;

    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $sequence = [];

    public function __construct(int $length = 255)
    {
        $this->values = range(0, $length);
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function setValues(array $values): void
    {
        $this->values = $values;
    }

    public function getLength(): int
    {
        return \count($this->values);
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function getSublist(int $length): array
    {
        $sublist = \array_slice($this->values, $this->position, $length);

        if ($this->sublistIsWrapping($length)) {
            $lengthOfSecondPart = $this->getLengthOfSecondPart($length);
            $sublist = array_merge($sublist, \array_slice($this->values, 0, $lengthOfSecondPart));
        }

        return $sublist;
    }

    public function reverseSublist(int $length): void
    {
        $sublist = $this->getSublist($length);
        $sublist = array_reverse($sublist);

        if ($this->sublistIsWrapping($length)) {
            $lengthOfFirstPart = $this->getLengthOfFirstPart();
            $lengthOfSecondPart = $this->getLengthOfSecondPart($length);
            array_splice($this->values, $this->position, $lengthOfFirstPart, \array_slice($sublist, 0, $lengthOfFirstPart));
            array_splice($this->values, 0, $lengthOfSecondPart, \array_slice($sublist, $lengthOfFirstPart));
        } else {
            array_splice($this->values, $this->position, $length, $sublist);
        }
    }

    public function movePosition(int $length): void
    {
        $this->position += $length;
    }

    /**
     * @param int $length
     * @return bool
     */
    private function sublistIsWrapping(int $length): bool
    {
        return $this->position + $length > $this->getLength();
    }

    /**
     * @return int
     */
    private function getLengthOfFirstPart(): int
    {
        return $this->getLength() - $this->position;
    }

    /**
     * @param int $length
     * @return int
     */
    private function getLengthOfSecondPart(int $length): int
    {
        return $length - $this->getLengthOfFirstPart();
    }

    public function forwardPosition(int $value): void
    {
        $this->position = ($this->position + $value) % $this->getLength();
    }

    public function getChecksum(): int
    {
        return (int)$this->values[0] * (int)$this->values[1];
    }

    public function getDenseHashChecksum(): string
    {
        $skipSize = 0;

        for ($round = 0; $round < 64; $round++) {
            foreach ($this->sequence as $item) {
                $this->reverseSublist($item);
                $this->forwardPosition($item + $skipSize);
                $skipSize++;
            }
        }

        $denseHash = $this->getDenseHash();
        $checksum = '';
        foreach ($denseHash as $value) {
            $checksum .= str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }

        return $checksum;
    }

    private function getDenseHash(): array
    {
        $denseHash = [];
        for ($i = 0; $i < 16; $i++) {
            $sublist = \array_slice($this->values, $i * 16, 16);
            $denseHash[] = $this->getDenseHashValue($sublist);
        }

        return $denseHash;
    }

    private function getDenseHashValue($sublist)
    {
        $value = array_shift($sublist);
        while (\count($sublist)) {
            $value ^= array_shift($sublist);
        }

        return $value;
    }

    public function setSequenceFromString(string $input, array $suffix = []): void
    {
        $values = [];
        if (trim($input) !== '') {
            $characters = str_split(trim($input));
            foreach ($characters as $character) {
                $values[] = \ord($character);
            }
        }

        $this->sequence = array_merge($values, $suffix);
    }

}
