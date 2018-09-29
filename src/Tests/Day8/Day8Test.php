<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day8;

class Day8Test extends TestCase
{
    /**
     * @var Day8
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day8();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle()
    {
        echo $this->subject->firstPuzzle(file_get_contents(__DIR__ . '/PuzzleData.txt'));
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle()
    {
        echo $this->subject->secondPuzzle(file_get_contents(__DIR__ . '/PuzzleData.txt'));
    }
}
