<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day15;

class Day15Test extends TestCase
{
    /**
     * @var Day15
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Day15();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testFirstPuzzle(): void
    {
        echo $this->subject->firstPuzzle('');
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSecondPuzzle(): void
    {
        echo $this->subject->secondPuzzle('');
    }
}
