<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day14;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day14;

class Day14Test extends TestCase
{
    /**
     * @var Day14
     */
    protected $subject;

    private $puzzleInput = 'jzgqcdpd';

    public function setUp()
    {
        $this->subject = new Day14();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle($this->puzzleInput);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle(): void
    {
        echo $this->subject->secondPuzzle($this->puzzleInput);
    }
}
