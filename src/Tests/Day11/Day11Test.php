<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day11;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day11;

class Day11Test extends TestCase
{
    /**
     * @var Day11
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day11();
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
}
