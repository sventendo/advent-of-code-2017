<?php

namespace Sventendo\AdventOfCode2017\Tests\Day\Day11;

use PHPUnit\Framework\TestCase;
use Sventendo\AdventOfCode2017\Day\Day11\Board;
use Sventendo\AdventOfCode2017\Day\Day11\Vector;

class BoardTest extends TestCase
{
    /**
     * @var Board
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new Board();
    }

    /**
     * @dataProvider getGetStepsFromOriginExamples
     *
     * @param array $position
     * @param int $steps
     */
    public function testGetStepsFromOrigin(array $position, int $steps): void
    {
        $this->subject->setPosition(new Vector($position[0], $position[1]));

        $this->assertEquals($steps, $this->subject->getStepsFromOrigin());
    }

    public function getGetStepsFromOriginExamples(): array
    {
        return [
            [[0, 2], 1],
            [[2, 0], 2],
            [[2, 2], 2],
            [[-4, -4], 4],
            [[-4, 2], 4],
        ];
    }
}
