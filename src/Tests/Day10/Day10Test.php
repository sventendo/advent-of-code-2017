<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day10;

class Day10Test extends TestCase
{
    /**
     * @var Day10
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day10();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle($this->getPuzzleInput());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle():void
    {
        echo $this->subject->secondPuzzle($this->getPuzzleInput());
    }

    private function getPuzzleInput(): string
    {
        return file_get_contents(__DIR__ . '/PuzzleData.txt');
    }
}
