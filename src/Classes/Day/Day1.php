<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;

class Day1 implements Day
{
    public function firstPuzzle(string $input): int
    {
        $numbers = str_split($input);
        $shiftOffset = 1;

        return $this->calculate($numbers, $shiftOffset);
    }

    public function secondPuzzle(string $input): int
    {
        $numbers = str_split($input);
        $shiftOffset = \count($numbers) / 2;

        return $this->calculate($numbers, $shiftOffset);
    }

    private function calculate(array $numbers, int $shiftOffset): int
    {
        $numbersShifted = $this->getNumbersShifted($numbers, $shiftOffset);

        $sum = 0;
        foreach ($numbers as $index => $number) {
            if ($number === $numbersShifted[$index]) {
                $sum += $number;
            }
        }

        return $sum;
    }

    /**
     * @param array $numbersShifted
     * @param int $shiftOffset
     * @return array
     */
    public function getNumbersShifted(array $numbersShifted, int $shiftOffset): array
    {
        $extractedSection = array_splice($numbersShifted, 0, $shiftOffset);
        $numbersShifted = array_merge($numbersShifted, $extractedSection);

        return $numbersShifted;
    }
}
