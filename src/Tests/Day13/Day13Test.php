<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day13;
use Sventendo\AdventOfCode2017\Day\Day13\Layer;

class Day13Test extends TestCase
{
    /**
     * @var Day13
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day13();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle($this->getPuzzleData());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle(): void
    {
        echo $this->subject->secondPuzzle($this->getPuzzleData());
    }

    private function getPuzzleData(): string
    {
        return file_get_contents(__DIR__ . '/PuzzleData.txt');
    }

    /**
     * @dataProvider getGetSeverityExamples
     *
     * @param array $layers
     * @param int $severity
     * @param int $delay
     */
    public function testGetSeverity(array $layers, int $severity, int $delay): void
    {
        $this->assertEquals($severity, $this->subject->getSeverity($layers, $delay));
    }

    /**
     * @dataProvider getGetSafeDelayExamples
     *
     * @param array $layers
     * @param int $safeDelay
     */
    public function testGetSafeDelay(array $layers, int $safeDelay): void
    {
        $this->assertEquals($safeDelay, $this->subject->getSafeDelay($layers));
    }

    public function getGetSeverityExamples(): array
    {
        return [
            [
                [
                    new Layer(0, 3),
                    new Layer(1, 2),
                    new Layer(4, 4),
                    new Layer(6, 4),
                ],
                24,
                0,
            ],
            [
                [
                    new Layer(0, 3),
                    new Layer(1, 2),
                    new Layer(4, 4),
                    new Layer(6, 4),
                ],
                0,
                10,
            ],
        ];
    }

    public function getGetSafeDelayExamples(): array
    {
        return [
            [
                [
                    new Layer(0, 3),
                    new Layer(1, 2),
                    new Layer(4, 4),
                    new Layer(6, 4),
                ],
                10,
            ],
        ];
    }
}
