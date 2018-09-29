<?php

namespace Sventendo\AdventOfCode2017\Day;

use AdventOfCode\Bootstrap\Day;
use Sventendo\AdventOfCode2017\Day\Day13\Layer;

class Day13 implements Day
{

    public function firstPuzzle(string $input): int
    {
        $layers = $this->parseData($input);

        return $this->getSeverity($layers);
    }

    public function secondPuzzle(string $input): int
    {
        $layers = $this->parseData($input);

        return $this->getSafeDelay($layers);
    }

    private function parseData(string $input): array
    {
        $layers = [];
        $rows = explode(PHP_EOL, $input);
        foreach ($rows as $row) {
            if (trim($row) !== '') {
                $bits = explode(':', $row);
                $layers[] = new Layer((int)$bits[0], (int)$bits[1]);
            }
        }

        return $layers;
    }

    /**
     * @param Layer[] $layers
     * @param int $delay
     * @return int
     */
    public function getSeverity(array $layers, int $delay = 0): int
    {
        $severity = 0;

        foreach ($layers as $layer) {
            if ($layer->getPositionAtBeginningOfPicoSecond($layer->getDepth(), $delay) === 0) {
                $severity += $layer->getDepth() * $layer->getRange();
            }
        }

        return $severity;
    }

    public function isCaught(array $layers, int $delay): bool
    {
        $caught = false;
        foreach ($layers as $layer) {
            if ($layer->getPositionAtBeginningOfPicoSecond($layer->getDepth(), $delay) === 0) {
                $caught = true;
                break;
            }
        }

        return $caught;
    }

    /**
     * @param Layer[] $layers
     * @return int
     */
    public function getSafeDelay(array $layers): int
    {
        $delay = 0;

        while ($this->isCaught($layers, $delay)) {
            $delay++;
        }

        return $delay;
    }
}
