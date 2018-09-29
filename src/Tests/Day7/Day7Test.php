<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day7;

class Day7Test extends TestCase
{

    /**
     * @var Day7
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day7();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle($this->getPuzzleData());
    }

    public function testSecondPuzzle(): void
    {
        echo $this->subject->secondPuzzle($this->getPuzzleData());

    }

    private function getPuzzleData(): string
    {
        return file_get_contents(__DIR__ . '/PuzzleData.txt');
    }
}
