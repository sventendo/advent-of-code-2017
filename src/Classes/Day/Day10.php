<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day10\ValueList;

class Day10 implements Day
{

    public function firstPuzzle(string $input): int
    {
        $sequence = $this->intExplode($input);
        $valueList = new ValueList(255);
        $skipSize = 0;

        foreach ($sequence as $item) {
            $valueList->reverseSublist($item);
            $valueList->forwardPosition($item + $skipSize);
            $skipSize++;
        }

        return $valueList->getChecksum();
    }

    public function secondPuzzle(string $input): string
    {
        $valueList = new ValueList(255);
        $valueList->setSequenceFromString($input, [17, 31, 73, 47, 23]);

        return $valueList->getDenseHashChecksum();
    }

    private function intExplode(string $input): array
    {
        $values = [];
        $stringBits = explode(',', $input);
        foreach ($stringBits as $stringBit) {
            if (trim($stringBit) !== '') {
                $values[] = (int)$stringBit;
            }
        }

        return $values;
    }
}
