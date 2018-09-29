<?php declare(strict_types=1);

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;

class Day2 implements Day
{
    public function firstPuzzle(string $input): int
    {
        return $this->calculateDifferenceChecksum($this->tabbedContentToArray($input));
    }

    public function secondPuzzle(string $input): int
    {
        return $this->calculateDivisionChecksum($this->tabbedContentToArray($input));
    }

    public function getDifferenceForRow(array $row): int
    {
        return max($row) - min($row);
    }

    public function calculateDifferenceChecksum(array $input): int
    {
        $sum = 0;

        foreach ($input as $row) {
            $sum += $this->getDifferenceForRow($row);
        }

        return $sum;
    }

    private function calculateDivisionChecksum(array $input): int
    {
        $sum = 0;

        foreach ($input as $row) {
            $sum += $this->getEvenDivisionResult($row);
        }

        return $sum;
    }

    public function readFile(string $filename): array
    {
        $content = file_get_contents($filename);

        return $this->tabbedContentToArray($content);
    }

    /**
     * @param $content
     * @return array
     */
    private function tabbedContentToArray($content): array
    {
        $rows = explode(PHP_EOL, $content);

        $array = [];

        foreach ($rows as $row) {
            if (!empty(trim($row))) {
                $array[] = preg_split('/\s+/', $row);
            }
        }

        return $array;
    }

    public function getEvenDivisionResult(array $input): int
    {
        $result = 0;

        while (\count($input) > 1 && $result === 0) {
            $candidate = (int)array_shift($input);
            foreach ($input as $value) {
                if ($this->isEvenlyDividable($candidate, (int)$value)) {
                    $result = $candidate / $value;
                    break;
                }

                if ($this->isEvenlyDividable((int)$value, $candidate)) {
                    $result = $value / $candidate;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * @param int $candidate
     * @param int $value
     * @return bool
     */
    public function isEvenlyDividable(int $candidate, int $value): bool
    {
        return (float)$candidate / $value === floor($candidate / $value);
    }
}
