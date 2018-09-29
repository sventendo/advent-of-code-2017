<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day9;

class Day9Test extends TestCase
{
    /**
     * @var Day9
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day9();
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
}
