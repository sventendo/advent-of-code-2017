<?php

namespace Sventendo\AdventOfCode2017\Tests\Day;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day3;

class Day3SecondPuzzleTest extends TestCase
{
    /**
     * @var Day3
     */
    private $subject;

    public function setUp()
    {
        $this->subject = new Day3();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testSpiral(): void
    {
        $this->subject->buildSpiral(277678);
    }
}
