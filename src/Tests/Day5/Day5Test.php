<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day5;

class Day5Test extends TestCase
{
    /**
     * @var Day5
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day5();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        $input = file_get_contents(__DIR__ . '/PuzzleData.txt');
        echo $this->subject->firstPuzzle($input);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle(): void
    {
        $input = file_get_contents(__DIR__ . '/PuzzleData.txt');
        echo $this->subject->secondPuzzle($input);
    }

    public function testOneJump(): void
    {
        $this->subject->initializeMaze([0, 0, 0]);
        $this->subject->jumpAndAddOne();

        $this->assertEquals([1, 0, 0], $this->subject->getMazeValues());
    }
    public function testTwoJumps(): void
    {
        $this->subject->initializeMaze([1, 0, 0]);
        $this->subject->jumpAndAddOne();
        $this->subject->jumpAndAddOne();

        $this->assertEquals([2, 1, 0], $this->subject->getMazeValues());
    }
}
